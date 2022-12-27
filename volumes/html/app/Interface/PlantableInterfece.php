<?php
namespace App\Interface;

interface PlantableInterfece
{
    function crop();

    function getId();

    function getName();

    function setName(string $name);
}
