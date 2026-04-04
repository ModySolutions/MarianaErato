<?php

namespace App\Features;

trait Template_Parser {
    public function parse(?string $template, array $data = []): string {
        if (empty($template)) {
            return '';
        }

        foreach($data as $key => $value) {
            $data["%{$key}%"] = $value;
            unset($data[$key]);
        }

        return str_replace(
            array_keys($data),
            array_values($data),
            $template
        );
    }
}
