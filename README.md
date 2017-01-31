# CQRS Infrastructure

This library gives you interfaces and abstract classes to implement in your CQSR application.

You can use it on a framework agnostic application core.

You can write your own implementation for your framework or use a symfony implementation, see here.

## Installation

### Step one: Add a repository to composer

To add a new repository, add this lines in your composer.json
```json
{
    ...
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/emhar/CqrsInfrastructure.git"
        }
    ]
    ...
}
```

### Step two: Download bundle
Open a command console, enter your project directory
and execute the following command to download the latest stable version of this bundle:
```bash
$ composer require emhar/cqrs-infrastructure
```

## Command

Each command of your application implements the ```CommandInterface```.
Each command has a handler. Handlers extend ```AbstractCommandHandler```.

You must implement a command bus, see ```CommandBusInterface```.

### Usage

* Repository
```php
class UserRepository implements \Emhar\CqrsInfrastructure\Repository\RepositoryInterface
{
    /**
     * @param string $email
     * @return User
     */
    public function find($email)
    {
        ...
    }
    
    /**
     * @param User $user
     */
    public function create(User $user)
    {
        ...
    }
    ...
}
```

* Command
```php
class UserRegisterCommand implements \Emhar\CqrsInfrastructure\Command\CommandInterface
{
    /**
     * @var string
     */
     public $name;
    
    /**
     * @var string
     */
     public $email;
    ...
}
```
* Command handler:
```php
class UserRegisterHandler implements \Emhar\CqrsInfrastructure\CommandHandler\AbstractCommandHandler
{
    /**
     * @var UserRepository
     */
     public $userRepository;
    
    public function process(CommandInterface $command)
    {
        if (!$command instanceof UserRegisterCommand) {
            throw new \InvalidArgumentException('"' . self::class . '" doesn\'t support "' . get_class($command) . '"');
        }
        if ($this->userRepository->find($command->email)) {
            throw new UserAlreadyExist($command->email);
        }
        $user = new User($command->email, $command->name);
        $this->userRepository->create($user)
    }
    ...
}
```

* Get a command result:
```php
try {
    /* @var $commandBus \Emhar\CqrsInfrastructure\CommandBus\CommandBusInterface */
    $result = $commandBus->getCommandResponse($command);
} catch(UserAlreadyExist $e) {
    // return a 409 http code for example
}
```

* Post a command if your bus is asynchronous:
```php
/* @var $commandBus \Emhar\CqrsInfrastructure\CommandBus\CommandBusInterface */
$result = $commandBus->postCommand($command);
```

## Events
During a command process, you can throw some events, for example by your model classes.

Event containers (classes that throw events) extend ```AbstractEventContainer``` or implements ```EventContainerInterface```.

Your command bus implementation must collect and dispatch this events.

### Usage

* Event class
```php
class UserRegistrationEvent implement implements \Emhar\CqrsInfrastructure\Event\Event
{
    /**
     * @var User
     */
     protected $user;
     
     public function __construct(User $user)
     {
        $this->user = $user;
     }
     
     /**
      * @return User
      */
     public function getUser(): User
     {
        return $this->user;
     }
}
```

* Event container
```php
class User extends AbstractEventContainer
{
    ...
    public function __construct(string $name, string $email)
    {
        ...
        $this->events[] = new UserRegistrationEvent($this);
    }
    ...
}
```

* Event subscriber
```php
class UserRegistrationMailSubscriber implements \Emhar\CqrsInfrastructure\EventSubscriber\EventSubscriberInterface
{
    /**
     * @var CommandBusInterface
     */
    protected $commandBus;

    /**
     * @param CommandBusInterface $commandBus
     */
    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            UserRegistrationEvent::class => 'onUserRegistration'
        );
    }

    /**
     * @param UserRegistrationEvent $event
     */
    public function onUserRegistration(UserRegistrationEvent $event)
    {
        $command = new UserRegistrationMailCommand();
        $command->recipient = $event->getUser()->getEmail();
        $command->userName = $event->getUser()->getName();
        $this->commandBus->postCommand($command);
    }
}
```