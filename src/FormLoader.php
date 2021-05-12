<?php

namespace FormGenerator;

class FormLoader
{
    /**
     * @var array<class-string>
     */
    private array $loadedForms = [];

    /**
     * @param array<class-string>|string $forms
     */
    public function loadForms($forms): void
    {
        if (is_array($forms)) {
            $this->loadedForms = $forms;
        } elseif (is_string($forms)) {
            if (preg_match_all('/\.json$/', $forms) === 1) {
                $this->loadedForms = array_merge($this->loadedForms, $this->parseJsonFile($forms));
            } elseif (preg_match_all('/\.php$/', $forms) === 1) {
                $this->loadedForms = array_merge($this->loadedForms, $this->parsePhpFile($forms));
            }
        }
    }

    /**
     * @return array<class-string>
     */
    public function getLoadedForms(): array
    {
        return $this->loadedForms;
    }

    /**
     * @return array<class-string>
     */
    private function parseJsonFile(string $json_file): array
    {
        return json_decode($this->obGetFileContent($json_file), true);
    }

    /**
     * @return array<class-string>
     */
    private function parsePhpFile(string $php_file): array
    {
        return require $php_file;
    }

    /**
     * @return mixed
     */
    private function obGetFileContent(string $file_path)
    {
        ob_start();
        require $file_path;
        return ob_get_clean();
    }
}
