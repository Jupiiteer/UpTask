<?php

namespace Model;

use Model\ActiveRecord;

class Proyecto extends ActiveRecord
{
    protected static $tabla = 'proyectos';
    protected static $columnasDB = ['id', 'proyecto', 'url', 'propietarioid'];
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->proyecto = $args['proyecto'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->propietarioid = $args['propietarioid'] ?? null;
    }

    public function validarProyecto()
    {
        if (!$this->proyecto) {
            self::$alertas['error'][] = "El nombre del proyecto es obligatorio";
        }

        return self::$alertas;
    }
}
