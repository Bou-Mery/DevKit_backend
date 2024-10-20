<?php

interface IDao{
    function create($o);
    function update($o);
    function delete($id);
    function findById($id);
    function findAll();
}

