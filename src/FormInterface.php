<?php

namespace FormGenerator;

interface FormInterface
{
    public function configurate(): void;

    public function options(): array;
}