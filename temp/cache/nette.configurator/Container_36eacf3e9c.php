<?php
// source: /var/www/proyecto/app/config/common.neon
// source: /var/www/proyecto/app/config/local.neon
// source: array

/** @noinspection PhpParamsInspection,PhpMethodMayBeStaticInspection */

declare(strict_types=1);

class Container_36eacf3e9c extends Nette\DI\Container
{
	protected $tags = [
		'nette.inject' => [
			'application.1' => true,
			'application.10' => true,
			'application.11' => true,
			'application.12' => true,
			'application.13' => true,
			'application.14' => true,
			'application.15' => true,
			'application.16' => true,
			'application.2' => true,
			'application.3' => true,
			'application.4' => true,
			'application.5' => true,
			'application.6' => true,
			'application.7' => true,
			'application.8' => true,
			'application.9' => true,
		],
	];

	protected $types = ['container' => 'Nette\DI\Container'];

	protected $aliases = [
		'application' => 'application.application',
		'cacheStorage' => 'cache.storage',
		'httpRequest' => 'http.request',
		'httpResponse' => 'http.response',
		'nette.httpRequestFactory' => 'http.requestFactory',
		'nette.latteFactory' => 'latte.latteFactory',
		'nette.mailer' => 'mail.mailer',
		'nette.presenterFactory' => 'application.presenterFactory',
		'nette.templateFactory' => 'latte.templateFactory',
		'nette.userStorage' => 'security.userStorage',
		'router' => 'routing.router',
		'session' => 'session.session',
		'user' => 'security.user',
	];

	protected $wiring = [
		'Nette\DI\Container' => [['container']],
		'Nette\Application\Application' => [['application.application']],
		'Nette\Application\IPresenterFactory' => [['application.presenterFactory']],
		'Nette\Application\LinkGenerator' => [['application.linkGenerator']],
		'Nette\Caching\IStorage' => [['cache.storage']],
		'Nette\Http\RequestFactory' => [['http.requestFactory']],
		'Nette\Http\IRequest' => [['http.request']],
		'Nette\Http\Request' => [['http.request']],
		'Nette\Http\IResponse' => [['http.response']],
		'Nette\Http\Response' => [['http.response']],
		'Nette\Bridges\ApplicationLatte\ILatteFactory' => [['latte.latteFactory']],
		'Nette\Application\UI\ITemplateFactory' => [['latte.templateFactory']],
		'Nette\Mail\IMailer' => [['mail.mailer']],
		'Nette\Routing\RouteList' => [['routing.router']],
		'Nette\Routing\Router' => [['routing.router']],
		'Nette\Application\IRouter' => [['routing.router']],
		'ArrayAccess' => [
			2 => [
				'routing.router',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
			],
		],
		'Countable' => [2 => ['routing.router']],
		'IteratorAggregate' => [2 => ['routing.router']],
		'Traversable' => [2 => ['routing.router']],
		'Nette\Application\Routers\RouteList' => [['routing.router']],
		'Nette\Security\Passwords' => [['security.passwords']],
		'Nette\Security\IUserStorage' => [['security.userStorage']],
		'Nette\Security\User' => [['security.user']],
		'Nette\Http\Session' => [['session.session']],
		'Tracy\ILogger' => [['tracy.logger']],
		'Tracy\BlueScreen' => [['tracy.blueScreen']],
		'Tracy\Bar' => [['tracy.bar']],
		'Nextras\Dbal\IConnection' => [['dbal.connection']],
		'Nextras\Dbal\Connection' => [['dbal.connection']],
		'Nextras\Orm\Mapper\Mapper' => [
			[
				'orm.mappers.platos',
				'orm.mappers.productos',
				'orm.mappers.ingredientes',
				'orm.mappers.mesas',
				'orm.mappers.menus',
				'orm.mappers.pedidos',
				'orm.mappers.categorias',
			],
		],
		'Nextras\Orm\Mapper\Dbal\DbalMapper' => [
			[
				'orm.mappers.platos',
				'orm.mappers.productos',
				'orm.mappers.ingredientes',
				'orm.mappers.mesas',
				'orm.mappers.menus',
				'orm.mappers.pedidos',
				'orm.mappers.categorias',
			],
		],
		'Nextras\Orm\Mapper\BaseMapper' => [
			[
				'orm.mappers.platos',
				'orm.mappers.productos',
				'orm.mappers.ingredientes',
				'orm.mappers.mesas',
				'orm.mappers.menus',
				'orm.mappers.pedidos',
				'orm.mappers.categorias',
			],
		],
		'Nextras\Orm\Mapper\IMapper' => [
			[
				'orm.mappers.platos',
				'orm.mappers.productos',
				'orm.mappers.ingredientes',
				'orm.mappers.mesas',
				'orm.mappers.menus',
				'orm.mappers.pedidos',
				'orm.mappers.categorias',
			],
		],
		'App\Model\Orm\PlatosMapper' => [['orm.mappers.platos']],
		'Nextras\Orm\Repository\Repository' => [
			[
				'orm.repositories.platos',
				'orm.repositories.productos',
				'orm.repositories.ingredientes',
				'orm.repositories.mesas',
				'orm.repositories.menus',
				'orm.repositories.pedidos',
				'orm.repositories.categorias',
			],
		],
		'Nextras\Orm\Repository\IRepository' => [
			[
				'orm.repositories.platos',
				'orm.repositories.productos',
				'orm.repositories.ingredientes',
				'orm.repositories.mesas',
				'orm.repositories.menus',
				'orm.repositories.pedidos',
				'orm.repositories.categorias',
			],
		],
		'App\Model\Orm\PlatosRepository' => [['orm.repositories.platos']],
		'App\Model\Orm\ProductosMapper' => [['orm.mappers.productos']],
		'App\Model\Orm\ProductosRepository' => [['orm.repositories.productos']],
		'App\Model\Orm\IngredientesMapper' => [['orm.mappers.ingredientes']],
		'App\Model\Orm\IngredientesRepository' => [['orm.repositories.ingredientes']],
		'App\Model\Orm\MesasMapper' => [['orm.mappers.mesas']],
		'App\Model\Orm\MesasRepository' => [['orm.repositories.mesas']],
		'App\Model\Orm\MenusMapper' => [['orm.mappers.menus']],
		'App\Model\Orm\MenusRepository' => [['orm.repositories.menus']],
		'App\Model\Orm\PedidosMapper' => [['orm.mappers.pedidos']],
		'App\Model\Orm\PedidosRepository' => [['orm.repositories.pedidos']],
		'App\Model\Orm\CategoriasMapper' => [['orm.mappers.categorias']],
		'App\Model\Orm\CategoriasRepository' => [['orm.repositories.categorias']],
		'Nextras\Orm\Model\IRepositoryLoader' => [['orm.repositoryLoader']],
		'Nextras\Orm\Bridges\NetteDI\RepositoryLoader' => [['orm.repositoryLoader']],
		'Nette\Caching\Cache' => [2 => ['orm.cache']],
		'Nextras\Orm\Repository\IDependencyProvider' => [['orm.dependencyProvider']],
		'Nextras\Orm\Bridges\NetteDI\DependencyProvider' => [['orm.dependencyProvider']],
		'Nextras\Orm\Mapper\Dbal\DbalMapperCoordinator' => [['orm.mapperCoordinator']],
		'Nextras\Orm\Entity\Reflection\IMetadataParserFactory' => [['orm.metadataParserFactory']],
		'Nextras\Orm\Entity\Reflection\MetadataParserFactory' => [['orm.metadataParserFactory']],
		'Nextras\Orm\Model\MetadataStorage' => [['orm.metadataStorage']],
		'Nextras\Orm\Model\Model' => [['orm.model']],
		'Nextras\Orm\Model\IModel' => [['orm.model']],
		'App\Model\Orm\Orm' => [['orm.model']],
		'Nette\Security\IAuthenticator' => [['01']],
		'App\Model\UserManager' => [['01']],
		'App\Forms\FormFactory' => [['02']],
		'App\Forms\SignInFormFactory' => [['03']],
		'App\Forms\SignUpFormFactory' => [['04']],
		'App\Presenters\BasePresenter' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
			],
		],
		'Nette\Application\UI\Presenter' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
			],
		],
		'Nette\Application\UI\Control' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
			],
		],
		'Nette\Application\UI\Component' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
			],
		],
		'Nette\ComponentModel\Container' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
			],
		],
		'Nette\ComponentModel\Component' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
			],
		],
		'Nette\Application\UI\IRenderable' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
			],
		],
		'Nette\ComponentModel\IContainer' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
			],
		],
		'Nette\ComponentModel\IComponent' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
			],
		],
		'Nette\Application\UI\ISignalReceiver' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
			],
		],
		'Nette\Application\UI\IStatePersistent' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
			],
		],
		'Nette\Application\IPresenter' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
				'application.15',
				'application.16',
			],
		],
		'App\Presenters\MesasPresenter' => [2 => ['application.1']],
		'App\Presenters\PedidosPresenter' => [2 => ['application.2']],
		'App\Presenters\HomepagePresenter' => [2 => ['application.3']],
		'App\Presenters\SignPresenter' => [2 => ['application.4']],
		'App\Presenters\Error4xxPresenter' => [2 => ['application.5']],
		'App\Presenters\ErrorPresenter' => [2 => ['application.6']],
		'App\AdminModule\Presenters\BaseAdminPresenter' => [
			2 => [
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
			],
		],
		'App\AdminModule\Presenters\MenusPresenter' => [2 => ['application.7']],
		'App\AdminModule\Presenters\MesasPresenter' => [2 => ['application.8']],
		'App\AdminModule\Presenters\PlatosPresenter' => [2 => ['application.9']],
		'App\AdminModule\Presenters\HomepagePresenter' => [2 => ['application.11']],
		'App\AdminModule\Presenters\SignPresenter' => [2 => ['application.12']],
		'App\AdminModule\Presenters\ProductosPresenter' => [2 => ['application.13']],
		'App\AdminModule\Presenters\CategoriasPresenter' => [2 => ['application.14']],
		'NetteModule\ErrorPresenter' => [2 => ['application.15']],
		'NetteModule\MicroPresenter' => [2 => ['application.16']],
	];


	public function __construct(array $params = [])
	{
		parent::__construct($params);
		$this->parameters += [
			'appDir' => '/var/www/proyecto/app',
			'wwwDir' => '/var/www/proyecto/www',
			'vendorDir' => '/var/www/proyecto/vendor',
			'debugMode' => true,
			'productionMode' => false,
			'consoleMode' => false,
			'tempDir' => '/var/www/proyecto/app/../temp',
		];
	}


	public function createService01(): App\Model\UserManager
	{
		$service = new App\Model\UserManager;
		return $service;
	}


	public function createService02(): App\Forms\FormFactory
	{
		$service = new App\Forms\FormFactory;
		return $service;
	}


	public function createService03(): App\Forms\SignInFormFactory
	{
		$service = new App\Forms\SignInFormFactory($this->getService('02'), $this->getService('security.user'));
		return $service;
	}


	public function createService04(): App\Forms\SignUpFormFactory
	{
		$service = new App\Forms\SignUpFormFactory($this->getService('02'), $this->getService('01'));
		return $service;
	}


	public function createServiceApplication__1(): App\Presenters\MesasPresenter
	{
		$service = new App\Presenters\MesasPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('routing.router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->orm = $this->getService('orm.model');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__10(): App\AdminModule\Presenters\BaseAdminPresenter
	{
		$service = new App\AdminModule\Presenters\BaseAdminPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('routing.router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->orm = $this->getService('orm.model');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__11(): App\AdminModule\Presenters\HomepagePresenter
	{
		$service = new App\AdminModule\Presenters\HomepagePresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('routing.router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->orm = $this->getService('orm.model');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__12(): App\AdminModule\Presenters\SignPresenter
	{
		$service = new App\AdminModule\Presenters\SignPresenter($this->getService('03'), $this->getService('04'));
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('routing.router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->orm = $this->getService('orm.model');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__13(): App\AdminModule\Presenters\ProductosPresenter
	{
		$service = new App\AdminModule\Presenters\ProductosPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('routing.router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->orm = $this->getService('orm.model');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__14(): App\AdminModule\Presenters\CategoriasPresenter
	{
		$service = new App\AdminModule\Presenters\CategoriasPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('routing.router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->orm = $this->getService('orm.model');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__15(): NetteModule\ErrorPresenter
	{
		$service = new NetteModule\ErrorPresenter($this->getService('tracy.logger'));
		return $service;
	}


	public function createServiceApplication__16(): NetteModule\MicroPresenter
	{
		$service = new NetteModule\MicroPresenter($this, $this->getService('http.request'), $this->getService('routing.router'));
		return $service;
	}


	public function createServiceApplication__2(): App\Presenters\PedidosPresenter
	{
		$service = new App\Presenters\PedidosPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('routing.router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->orm = $this->getService('orm.model');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__3(): App\Presenters\HomepagePresenter
	{
		$service = new App\Presenters\HomepagePresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('routing.router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->orm = $this->getService('orm.model');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__4(): App\Presenters\SignPresenter
	{
		$service = new App\Presenters\SignPresenter($this->getService('03'), $this->getService('04'));
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('routing.router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->orm = $this->getService('orm.model');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__5(): App\Presenters\Error4xxPresenter
	{
		$service = new App\Presenters\Error4xxPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('routing.router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->orm = $this->getService('orm.model');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__6(): App\Presenters\ErrorPresenter
	{
		$service = new App\Presenters\ErrorPresenter($this->getService('tracy.logger'));
		return $service;
	}


	public function createServiceApplication__7(): App\AdminModule\Presenters\MenusPresenter
	{
		$service = new App\AdminModule\Presenters\MenusPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('routing.router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->orm = $this->getService('orm.model');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__8(): App\AdminModule\Presenters\MesasPresenter
	{
		$service = new App\AdminModule\Presenters\MesasPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('routing.router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->orm = $this->getService('orm.model');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__9(): App\AdminModule\Presenters\PlatosPresenter
	{
		$service = new App\AdminModule\Presenters\PlatosPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('routing.router'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->orm = $this->getService('orm.model');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__application(): Nette\Application\Application
	{
		$service = new Nette\Application\Application(
			$this->getService('application.presenterFactory'),
			$this->getService('routing.router'),
			$this->getService('http.request'),
			$this->getService('http.response')
		);
		$service->catchExceptions = false;
		$service->errorPresenter = 'Error';
		Nette\Bridges\ApplicationTracy\RoutingPanel::initializePanel($service);
		$this->getService('tracy.bar')->addPanel(new Nette\Bridges\ApplicationTracy\RoutingPanel(
			$this->getService('routing.router'),
			$this->getService('http.request'),
			$this->getService('application.presenterFactory')
		));
		return $service;
	}


	public function createServiceApplication__linkGenerator(): Nette\Application\LinkGenerator
	{
		$service = new Nette\Application\LinkGenerator(
			$this->getService('routing.router'),
			$this->getService('http.request')->getUrl(),
			$this->getService('application.presenterFactory')
		);
		return $service;
	}


	public function createServiceApplication__presenterFactory(): Nette\Application\IPresenterFactory
	{
		$service = new Nette\Application\PresenterFactory(new Nette\Bridges\ApplicationDI\PresenterFactoryCallback($this, 5, '/var/www/proyecto/app/../temp/cache/nette.application/touch'));
		$service->setMapping(['*' => 'App\*Module\Presenters\*Presenter']);
		return $service;
	}


	public function createServiceCache__storage(): Nette\Caching\IStorage
	{
		$service = new Nette\Caching\Storages\FileStorage('/var/www/proyecto/app/../temp/cache');
		return $service;
	}


	public function createServiceContainer(): Container_36eacf3e9c
	{
		return $this;
	}


	public function createServiceDbal__connection(): Nextras\Dbal\Connection
	{
		$service = new Nextras\Dbal\Connection([
			'driver' => 'mysqli',
			'host' => '127.0.0.1',
			'database' => 'oidococina',
			'username' => 'root',
			'password' => 1234,
		]);
		$this->getService('tracy.blueScreen')->addPanel('Nextras\Dbal\Bridges\NetteTracy\BluescreenQueryPanel::renderBluescreenPanel');
		Nextras\Dbal\Bridges\NetteTracy\ConnectionPanel::install($service, true);
		return $service;
	}


	public function createServiceHttp__request(): Nette\Http\Request
	{
		$service = $this->getService('http.requestFactory')->createHttpRequest();
		return $service;
	}


	public function createServiceHttp__requestFactory(): Nette\Http\RequestFactory
	{
		$service = new Nette\Http\RequestFactory;
		$service->setProxy([]);
		return $service;
	}


	public function createServiceHttp__response(): Nette\Http\Response
	{
		$service = new Nette\Http\Response;
		return $service;
	}


	public function createServiceLatte__latteFactory(): Nette\Bridges\ApplicationLatte\ILatteFactory
	{
		return new class ($this) implements Nette\Bridges\ApplicationLatte\ILatteFactory {
			private $container;


			public function __construct(Container_36eacf3e9c $container)
			{
				$this->container = $container;
			}


			public function create(): Latte\Engine
			{
				$service = new Latte\Engine;
				$service->setTempDirectory('/var/www/proyecto/app/../temp/cache/latte');
				$service->setAutoRefresh(true);
				$service->setContentType('html');
				Nette\Utils\Html::$xhtml = false;
				return $service;
			}
		};
	}


	public function createServiceLatte__templateFactory(): Nette\Application\UI\ITemplateFactory
	{
		$service = new Nette\Bridges\ApplicationLatte\TemplateFactory(
			$this->getService('latte.latteFactory'),
			$this->getService('http.request'),
			$this->getService('security.user'),
			$this->getService('cache.storage'),
			null
		);
		return $service;
	}


	public function createServiceMail__mailer(): Nette\Mail\IMailer
	{
		$service = new Nette\Mail\SendmailMailer;
		return $service;
	}


	public function createServiceOrm__cache(): Nette\Caching\Cache
	{
		$service = new Nette\Caching\Cache($this->getService('cache.storage'), 'orm');
		return $service;
	}


	public function createServiceOrm__dependencyProvider(): Nextras\Orm\Bridges\NetteDI\DependencyProvider
	{
		$service = new Nextras\Orm\Bridges\NetteDI\DependencyProvider($this);
		return $service;
	}


	public function createServiceOrm__mapperCoordinator(): Nextras\Orm\Mapper\Dbal\DbalMapperCoordinator
	{
		$service = new Nextras\Orm\Mapper\Dbal\DbalMapperCoordinator($this->getService('dbal.connection'));
		return $service;
	}


	public function createServiceOrm__mappers__categorias(): App\Model\Orm\CategoriasMapper
	{
		$service = new App\Model\Orm\CategoriasMapper(
			$this->getService('dbal.connection'),
			$this->getService('orm.mapperCoordinator'),
			$this->getService('orm.cache')
		);
		return $service;
	}


	public function createServiceOrm__mappers__ingredientes(): App\Model\Orm\IngredientesMapper
	{
		$service = new App\Model\Orm\IngredientesMapper(
			$this->getService('dbal.connection'),
			$this->getService('orm.mapperCoordinator'),
			$this->getService('orm.cache')
		);
		return $service;
	}


	public function createServiceOrm__mappers__menus(): App\Model\Orm\MenusMapper
	{
		$service = new App\Model\Orm\MenusMapper(
			$this->getService('dbal.connection'),
			$this->getService('orm.mapperCoordinator'),
			$this->getService('orm.cache')
		);
		return $service;
	}


	public function createServiceOrm__mappers__mesas(): App\Model\Orm\MesasMapper
	{
		$service = new App\Model\Orm\MesasMapper(
			$this->getService('dbal.connection'),
			$this->getService('orm.mapperCoordinator'),
			$this->getService('orm.cache')
		);
		return $service;
	}


	public function createServiceOrm__mappers__pedidos(): App\Model\Orm\PedidosMapper
	{
		$service = new App\Model\Orm\PedidosMapper(
			$this->getService('dbal.connection'),
			$this->getService('orm.mapperCoordinator'),
			$this->getService('orm.cache')
		);
		return $service;
	}


	public function createServiceOrm__mappers__platos(): App\Model\Orm\PlatosMapper
	{
		$service = new App\Model\Orm\PlatosMapper(
			$this->getService('dbal.connection'),
			$this->getService('orm.mapperCoordinator'),
			$this->getService('orm.cache')
		);
		return $service;
	}


	public function createServiceOrm__mappers__productos(): App\Model\Orm\ProductosMapper
	{
		$service = new App\Model\Orm\ProductosMapper(
			$this->getService('dbal.connection'),
			$this->getService('orm.mapperCoordinator'),
			$this->getService('orm.cache')
		);
		return $service;
	}


	public function createServiceOrm__metadataParserFactory(): Nextras\Orm\Entity\Reflection\MetadataParserFactory
	{
		$service = new Nextras\Orm\Entity\Reflection\MetadataParserFactory;
		return $service;
	}


	public function createServiceOrm__metadataStorage(): Nextras\Orm\Model\MetadataStorage
	{
		$service = new Nextras\Orm\Model\MetadataStorage(
			[
				'App\Model\Orm\Plato' => 'App\Model\Orm\PlatosRepository',
				'App\Model\Orm\Producto' => 'App\Model\Orm\ProductosRepository',
				'App\Model\Orm\Ingrediente' => 'App\Model\Orm\IngredientesRepository',
				'App\Model\Orm\Mesa' => 'App\Model\Orm\MesasRepository',
				'App\Model\Orm\Menu' => 'App\Model\Orm\MenusRepository',
				'App\Model\Orm\Pedido' => 'App\Model\Orm\PedidosRepository',
				'App\Model\Orm\Categoria' => 'App\Model\Orm\CategoriasRepository',
			],
			$this->getService('orm.cache'),
			$this->getService('orm.metadataParserFactory'),
			$this->getService('orm.repositoryLoader')
		);
		return $service;
	}


	public function createServiceOrm__model(): App\Model\Orm\Orm
	{
		$service = new App\Model\Orm\Orm(
			[
				[
					'App\Model\Orm\PlatosRepository' => true,
					'App\Model\Orm\ProductosRepository' => true,
					'App\Model\Orm\IngredientesRepository' => true,
					'App\Model\Orm\MesasRepository' => true,
					'App\Model\Orm\MenusRepository' => true,
					'App\Model\Orm\PedidosRepository' => true,
					'App\Model\Orm\CategoriasRepository' => true,
				],
				[
					'platos' => 'App\Model\Orm\PlatosRepository',
					'productos' => 'App\Model\Orm\ProductosRepository',
					'ingredientes' => 'App\Model\Orm\IngredientesRepository',
					'mesas' => 'App\Model\Orm\MesasRepository',
					'menus' => 'App\Model\Orm\MenusRepository',
					'pedidos' => 'App\Model\Orm\PedidosRepository',
					'categorias' => 'App\Model\Orm\CategoriasRepository',
				],
				[
					'App\Model\Orm\Plato' => 'App\Model\Orm\PlatosRepository',
					'App\Model\Orm\Producto' => 'App\Model\Orm\ProductosRepository',
					'App\Model\Orm\Ingrediente' => 'App\Model\Orm\IngredientesRepository',
					'App\Model\Orm\Mesa' => 'App\Model\Orm\MesasRepository',
					'App\Model\Orm\Menu' => 'App\Model\Orm\MenusRepository',
					'App\Model\Orm\Pedido' => 'App\Model\Orm\PedidosRepository',
					'App\Model\Orm\Categoria' => 'App\Model\Orm\CategoriasRepository',
				],
			],
			$this->getService('orm.repositoryLoader'),
			$this->getService('orm.metadataStorage')
		);
		return $service;
	}


	public function createServiceOrm__repositories__categorias(): App\Model\Orm\CategoriasRepository
	{
		$service = new App\Model\Orm\CategoriasRepository($this->getService('orm.mappers.categorias'), $this->getService('orm.dependencyProvider'));
		$service->setModel($this->getService('orm.model'));
		return $service;
	}


	public function createServiceOrm__repositories__ingredientes(): App\Model\Orm\IngredientesRepository
	{
		$service = new App\Model\Orm\IngredientesRepository($this->getService('orm.mappers.ingredientes'), $this->getService('orm.dependencyProvider'));
		$service->setModel($this->getService('orm.model'));
		return $service;
	}


	public function createServiceOrm__repositories__menus(): App\Model\Orm\MenusRepository
	{
		$service = new App\Model\Orm\MenusRepository($this->getService('orm.mappers.menus'), $this->getService('orm.dependencyProvider'));
		$service->setModel($this->getService('orm.model'));
		return $service;
	}


	public function createServiceOrm__repositories__mesas(): App\Model\Orm\MesasRepository
	{
		$service = new App\Model\Orm\MesasRepository($this->getService('orm.mappers.mesas'), $this->getService('orm.dependencyProvider'));
		$service->setModel($this->getService('orm.model'));
		return $service;
	}


	public function createServiceOrm__repositories__pedidos(): App\Model\Orm\PedidosRepository
	{
		$service = new App\Model\Orm\PedidosRepository($this->getService('orm.mappers.pedidos'), $this->getService('orm.dependencyProvider'));
		$service->setModel($this->getService('orm.model'));
		return $service;
	}


	public function createServiceOrm__repositories__platos(): App\Model\Orm\PlatosRepository
	{
		$service = new App\Model\Orm\PlatosRepository($this->getService('orm.mappers.platos'), $this->getService('orm.dependencyProvider'));
		$service->setModel($this->getService('orm.model'));
		return $service;
	}


	public function createServiceOrm__repositories__productos(): App\Model\Orm\ProductosRepository
	{
		$service = new App\Model\Orm\ProductosRepository($this->getService('orm.mappers.productos'), $this->getService('orm.dependencyProvider'));
		$service->setModel($this->getService('orm.model'));
		return $service;
	}


	public function createServiceOrm__repositoryLoader(): Nextras\Orm\Bridges\NetteDI\RepositoryLoader
	{
		$service = new Nextras\Orm\Bridges\NetteDI\RepositoryLoader(
			$this,
			[
				'App\Model\Orm\PlatosRepository' => 'orm.repositories.platos',
				'App\Model\Orm\ProductosRepository' => 'orm.repositories.productos',
				'App\Model\Orm\IngredientesRepository' => 'orm.repositories.ingredientes',
				'App\Model\Orm\MesasRepository' => 'orm.repositories.mesas',
				'App\Model\Orm\MenusRepository' => 'orm.repositories.menus',
				'App\Model\Orm\PedidosRepository' => 'orm.repositories.pedidos',
				'App\Model\Orm\CategoriasRepository' => 'orm.repositories.categorias',
			]
		);
		return $service;
	}


	public function createServiceRouting__router(): Nette\Application\Routers\RouteList
	{
		$service = App\Router\RouterFactory::createRouter();
		return $service;
	}


	public function createServiceSecurity__passwords(): Nette\Security\Passwords
	{
		$service = new Nette\Security\Passwords;
		return $service;
	}


	public function createServiceSecurity__user(): Nette\Security\User
	{
		$service = new Nette\Security\User($this->getService('security.userStorage'), $this->getService('01'));
		$this->getService('tracy.bar')->addPanel(new Nette\Bridges\SecurityTracy\UserPanel($service));
		return $service;
	}


	public function createServiceSecurity__userStorage(): Nette\Security\IUserStorage
	{
		$service = new Nette\Http\UserStorage($this->getService('session.session'));
		return $service;
	}


	public function createServiceSession__session(): Nette\Http\Session
	{
		$service = new Nette\Http\Session($this->getService('http.request'), $this->getService('http.response'));
		$service->setExpiration('14 days');
		return $service;
	}


	public function createServiceTracy__bar(): Tracy\Bar
	{
		$service = Tracy\Debugger::getBar();
		return $service;
	}


	public function createServiceTracy__blueScreen(): Tracy\BlueScreen
	{
		$service = Tracy\Debugger::getBlueScreen();
		return $service;
	}


	public function createServiceTracy__logger(): Tracy\ILogger
	{
		$service = Tracy\Debugger::getLogger();
		return $service;
	}


	public function initialize()
	{
		$this->getService('tracy.bar')->addPanel(new Nette\Bridges\DITracy\ContainerPanel($this));
		(function () {
			$response = $this->getService('http.response');
			$response->setHeader('X-Powered-By', 'Nette Framework 3');
			$response->setHeader('Content-Type', 'text/html; charset=utf-8');
			$response->setHeader('X-Frame-Options', 'SAMEORIGIN');
			$response->setCookie('nette-samesite', '1', 0, '/', null, null, true, 'Strict');
		})();
		$this->getService('session.session')->exists() && $this->getService('session.session')->start();
		Tracy\Debugger::$editorMapping = [];
		Tracy\Debugger::getLogger()->mailer = [new Tracy\Bridges\Nette\MailSender($this->getService('mail.mailer'), null), 'send'];
		$this->getService('session.session')->start();
		Tracy\Debugger::dispatch();
	}
}
