<?php
namespace App\Features;

class Template_Parser {
    protected array $placeholders = [];

    public function __construct($order_id = null) {
        $this->load_context($order_id);
    }

    private function load_context($order_id): void {
        $user = wp_get_current_user();
        $this->placeholders['current_user'] = (array) $user->data;
        $this->placeholders['current_user']['first_name'] = $user->first_name;
        $this->placeholders['current_user']['last_name'] = $user->last_name;

        $this->placeholders['site'] = [
            'name'        => get_bloginfo('name'),
            'url'         => get_bloginfo('url'),
            'description' => get_bloginfo('description'),
            'admin_email' => get_bloginfo('admin_email'),
            'language'    => get_bloginfo('language'),
        ];

        if ($order_id) {
            $order = wc_get_order($order_id);
            if ($order) {
                $this->placeholders['order'] = [
                    'id'    => $order->get_id(),
                    'total' => $order->get_total(),
                    'currency' => $order->get_currency(),
                    'date'  => $order->get_date_created()->date('Y-m-d'),
                ];
            }
        }
    }

    public function parse(?string $content): string {
        if (empty($content)) return '';

        return preg_replace_callback('/{{\s*(.+?)\s*}}/', function($matches) {
            $path = explode('.', trim($matches[1]));
            return $this->resolve_path($path);
        }, $content);
    }

    private function resolve_path(array $path) {
        $data = $this->placeholders;
        foreach ($path as $key) {
            if (is_array($data) && array_key_exists($key, $data)) {
                $data = $data[$key];
            } else {
                return $matches[0] ?? '';
            }
        }
        return is_scalar($data) ? $data : '';
    }
}
