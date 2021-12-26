# Service Object

`Service Objects` help keep your models and controllers skinny, whilst keeping your code clean and testable. The `Service Object` also helps you
seperate your application business logic from the framework and also makes it easy to test in isolation. They are also super DI-able.

With `Service Objects` have all dependencies added to the `__constructor` method and do not carry state, remember the `The Dependency Rule`, this means that code dependencies can only point inwards.

The `Service Object` is based upon the command pattern and follows the [single responsibility principle](https://en.wikipedia.org/wiki/Single-responsibility_principle), with a single method  `execute` method where the logic goes and this method must return a `Result` object. 

## Usage

> You can also use create a Service Object with a POPO (Plain Old PHP Object) (not adding the interface), implementing an execute method with the arguments that you desire and return a `Result` object. This has the added benefit of type hinting params required.

Create your service with the dependencies in `__constructor` method and create the method like `execute`, you should always use the same name, since commands are typically executed, no need here to use something else. The method must always return a `Result` object.

```php
class CreateUserService implements ServiceObjectInterface
{
    private Model $user; 
    private LoggerInterface $logger

    public function __construct(Model $user, LoggerInterface $logger) 
    {
        $this->user = $user;
        $this->logger = $logger;
    } 

    /**
     * Executes this service
     *
     * @param Params $params The following params are needed:
     *  - tenant_id: tenant id
     *  - owner_id: the ID of the user creating this
     * @return Result
     */
    public function execute(Params $params) : Result
    {
       $user = [];
       $result = $this->createInDb($params->get('tenant_id'), $params->get('owner_id'));
    
       if($result){
            $user = $this->fetchUser();
            $this->notifyViaSMS($user);
            $this->somethingForTheWeekend($user);
       }

       return new Result($result, $user);
    }
}
```

To execute

```php
$params = new Params(['foo' => 'bar']);
$result = (new CreateUserService($userModel, $logger))->execute($params);
```

## Params Object

The params object is an immutable object, trying to get a value that was provided from the `Params` object will result in an `UnknownParameterException`. For optional params always call the `has` method first.

```php
$params = new Params(['foo'=>'bar']);

$bool = $params->has('foo');

// To get a param
$value = $params->get('foo');
$value = $params->foo; 

$array = $params->toArray();
```

## Result Object

Depending what the service layer is doing sometimes you will need to just return a simple true or false and other times you will need more information.

To create a  `Result` object

```php
$result = new Result(false);
$result = new Result(true, ['message' => 'ok']);
```

Methods available on `Result` object

```php
// check status
$result->isSuccess();
$result->isError();

// work with data
$result->hasData();
$result->getData();
$result->getData('message');
$string = (string) $result;
```

## Do nots

- Do not use an object that did not come from the constructor

- Do not call other Service Objects from within a Service Object, if you need to, then perhaps look at refactoring, such as moving the logic to a single class, which can be passed as a dependency instead. Some people from large projects say this leads to complication and harder to find problems. If you must then make sure its a dependency in the constructor.

- Do nots put all business logic in service objects, Service objects are more functional in nature and call and use your domain model objects which is where the business logic should be. See [anemic domain model](https://martinfowler.com/bliki/AnemicDomainModel.html) on putting all your business logic in services.

## Resources

- [clean architecture](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html)

