<?php

class Entity extends \Eloquent
{
    protected $table = 'entities';
    protected $fillable = ['title', 'description'];
}