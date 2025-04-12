<?php
// Ativando exibição de erros para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Importando as classes do PHPMailer
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

try {
    // Criando uma nova instância do PHPMailer
    $mail = new PHPMailer(true);

    // Configurações do servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'adm@trend.net.br';
    $mail->Password = '@Mudar2025';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    // Configurações do email
    $mail->setFrom('adm@trend.net.br', 'Maratona da Programação');
    $mail->addAddress('rh@trend.net.br', 'RH Trend IT');
    
    // Adicionando o candidato em cópia
    if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $mail->addCC($_POST['email']);
    }

    // Debug - Verificando os dados recebidos
    error_log("Dados do POST: " . print_r($_POST, true));

    // Conteúdo do email
    $mail->isHTML(true);
    $mail->Subject = 'Nova Inscrição - Maratona da Programação';

    // Montando o corpo do email
    $body = "<h2>Nova Inscrição na Maratona da Programação</h2>";
    $body .= "<p><strong>Nome:</strong> " . htmlspecialchars($_POST['nome']) . "</p>";
    $body .= "<p><strong>Data de Nascimento:</strong> " . htmlspecialchars($_POST['dataNascimento']) . "</p>";
    $body .= "<p><strong>Telefone:</strong> " . htmlspecialchars($_POST['telefone']) . "</p>";
    $body .= "<p><strong>Email:</strong> " . htmlspecialchars($_POST['email']) . "</p>";
    $body .= "<p><strong>Conhecimento em Programação:</strong> " . htmlspecialchars($_POST['conhecimentoPrevio']) . "</p>";
    $body .= "<p><strong>Motivação:</strong> " . htmlspecialchars($_POST['motivacao']) . "</p>";
    $body .= "<p><strong>Nível de Dedicação:</strong> " . htmlspecialchars($_POST['nivelDedicacao']) . "</p>";
    $body .= "<p><strong>Capacidades Lógicas e Autodidata:</strong> " . htmlspecialchars($_POST['capacidades']) . "</p>";

    $mail->Body = $body;
    $mail->AltBody = strip_tags($body); // Versão texto plano do email

    // Enviando o email
    if (!$mail->send()) {
        throw new Exception($mail->ErrorInfo);
    }
    
    // Redirecionando com sucesso
    header('Location: index.html?status=success');
    exit();

} catch (Exception $e) {
    error_log("Exceção capturada: " . $e->getMessage());
    // Redirecionando com erro
    header('Location: index.html?status=error&message=' . urlencode($e->getMessage()));
    exit();
}
?>
