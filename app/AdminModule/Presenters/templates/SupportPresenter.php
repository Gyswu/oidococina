<?php

namespace App\AdminModule\Presenters;

use App\Forms\FormFactory;
use Nette\Forms\Form;
use PHPMailer\PHPMailer\PHPMailer;

class SupportPresenter extends BaseAdminPresenter {
    
    public function createComponentCorreoForm() {
        
        $form = ( new FormFactory() )->create();
        $form->addText('nombre', 'Nombre de la empresa')
             ->setRequired();
        $form->addText('tel', 'Telefono de contacto')
             ->setRequired()
             ->addRule(Form::INTEGER, 'Debe ser un numero');
        $form->addEmail('correo', 'Email:')
             ->setRequired();
        $form->addSelect('category', 'Categoria', [
            'error'      => 'Error',
            'sugerencia' => 'Sugerencia',
            'contacto'   => 'Contacto',
            'peticion'   => 'Peticion',
        ]);
        $form->addTextArea('comentario', 'Escriba aquí su mensaje')
             ->setRequired();
        $form->addSubmit('send', 'Enviar')
             ->setHtmlAttribute("class", 'btn btn-success');
        $form->onSuccess[] = [ $this, 'onSuccessEnviarCorreo' ];
        
        return $form;
    }
    
    public function onSuccessEnviarCorreo( \Nette\Application\UI\Form $form, \stdClass $values ): void {
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        // 0 Es deshabilitado
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "o.lugovskyy@gmail.com";
        $mail->Password = "tgbdjetbxtusspud";
        $mail->setFrom('o.lugovskyy@gmail.com', 'Support OidoCocina');
        $mail->addAddress($values->correo);
        $mail->addBCC('o.lugovskyy@gmail.com');
        $mail->Subject = 'NoReply ' . $values->nombre . '-' . $values->category;
        $mail->isHTML(true);
        $mail->Body = 'Este es un correo generado y enviado automaticamente
                        <table>
                            <tr>
                                <td>
                                <b>Empresa</b>
                                </td>
                                <td> ' . $values->nombre . '</td>
                            </tr>
                            <tr>
                                <td>
                                <b>Correo:</b>
                                </td>
                                <td>
                                ' . $values->correo . '
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <b>Razón</b>
                                </td>
                                <td>' . $values->category . '</td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                    Comentario
                                    </b>
                                </td>
                                <td>' . $values->comentario . '</td>
                            </tr>
                        </table>';
        if( !$mail->send() ) {
            $this->flashMessage('Ha habido un error en el sistema', 'error');
            $this->redirect('this');
        } else {
            $this->flashMessage('El mensaje ha sido enviado', 'success');
            $this->redirect('this');
        }
    }
}