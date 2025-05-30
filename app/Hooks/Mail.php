<?php

namespace App\Hooks;

use Timber\Timber;

class Mail
{
    public function init(): void
    {
        // @todo change email template to this.
        //        add_filter('wp_mail', [$this, 'wp_mail']);
        //        add_filter('wp_mail_content_type', [$this, 'wp_mail_content_type']);
    }

    public function wp_mail(array $args): bool
    {
        $context = Timber::context([
            'site_url' => home_url(),
            'year' => gmdate('Y'),
            'lang' => get_language_attributes('html'),
            'message' => $args['message'],
        ]);
        $context['logo'] = Timber::compile('@app/common/logos/email-logo.twig', $context + ['link' => home_url()]);
        $args['message'] = Timber::compile('@app/mail/template.twig', $context);

        $to = $args['to'];
        $subject = $args['subject'];
        $message = $args['message'];
        $headers = $args['headers'] ?? [];

        return $this->sendgrid_send_mail($to, $subject, $message, $headers);
    }

    public function wp_mail_content_type(): string
    {
        return 'text/html';
    }

    public function sendgrid_send_mail($to, $subject, $message, $headers = []): bool
    {
        if (!SENDGRID_API_URL) {
            return false;
        }

        $url = SENDGRID_API_URL;
        $email_data = [
            'personalizations' => [[
                'to' => is_array($to) ? array_map(fn($email) => ['email' => $email], $to) : [['email' => $to]],
                'subject' => $subject,
            ]],
            'from' => [
                'email' => EMAIL_FROM,
                'name'  => EMAIL_FROM_NAME,
            ],
            'content' => [[
                'type' => 'text/html',
                'value' => nl2br($message),
            ]],
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($email_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . SENDGRID_API_KEY,
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($http_code >= 200 && $http_code < 300);
    }
}
