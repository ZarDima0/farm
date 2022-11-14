<?php
namespace App\Interface;

interface PlantableInterfece
{
    function crop();

    function getName();

    function setName(string $name);
}
