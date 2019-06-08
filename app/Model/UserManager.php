<?php
declare( strict_types = 1 );

namespace App\Model;

use App\Model\Orm\Orm;
use Nette;
use Nette\Security\Passwords;

/**
 * Users management.
 */
final class UserManager implements Nette\Security\IAuthenticator {
    
    use Nette\SmartObject;
    
    private const
        TABLE_NAME = 'users',
        COLUMN_ID = 'id',
        COLUMN_NAME = 'username',
        COLUMN_PASSWORD_HASH = 'password',
        COLUMN_EMAIL = 'email',
        COLUMN_ROLE = 'role';
    
    /** @var Orm @inject */
    private $orm;
    
    public function __construct( Orm $orm ) {
        $this->orm = $orm;
    }
    
    /**
     * Performs an authentication.
     * @throws Nette\Security\AuthenticationException
     */
    public function authenticate( array $credentials ): Nette\Security\IIdentity {
        [ $userID, $password ] = $credentials;
//		$row = $this->database->table(self::TABLE_NAME)
//			->where(self::COLUMN_NAME, $username)
//			->fetch();
        $usuario = $this->orm->usuarios->getBy([ 'id' => $userID ]);
        if( !$usuario ) {
            throw new Nette\Security\AuthenticationException('Usuario incorrecto, selecciona uno de la lista.', self::IDENTITY_NOT_FOUND);
        } elseif( $usuario->pin != $password ) {
            throw new Nette\Security\AuthenticationException('Pin incorrecto.', self::INVALID_CREDENTIAL);
        }
    
        $arr = $usuario->toArray();
        unset($arr['pin']);
        return new Nette\Security\Identity($usuario->id, $usuario->rol, $arr);
    }
    
    /**
     * Adds new user.
     * @throws DuplicateNameException
     */
    public function add( string $username, string $email, string $password ): void {
        Nette\Utils\Validators::assert($email, 'email');
        try {
            $this->database->table(self::TABLE_NAME)->insert([
                                                                 self::COLUMN_NAME          => $username,
                                                                 self::COLUMN_PASSWORD_HASH => $this->passwords->hash($password),
                                                                 self::COLUMN_EMAIL         => $email,
                                                             ]);
        } catch( Nette\Database\UniqueConstraintViolationException $e ) {
            throw new DuplicateNameException;
        }
    }
}



class DuplicateNameException extends \Exception {

}
