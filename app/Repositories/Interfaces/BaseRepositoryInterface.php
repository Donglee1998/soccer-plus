<?php
namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    /**
    * Retrieve all data of repository
    */
    public function all($columns = ['*']);

    /**
    * Retrieve all data of repository
    */
    public function list(array $condition, $columns = ['*']);

    /**
     * Find data by id
     */
    public function find($id, $columns = ['*']);

    /**
     * paginate
     */
    public function paginate($limit = null, $columns = ['*']);

    /**
     * Save a new entity in repository
     */
    public function create(array $input);

    /**
     * Update a entity in repository
     */
    public function update(array $input, $id);

    /**
     * Delete a entity in repository
     */
    public function delete($id);

    /**
     * Destroy the mass resources.
     */
    public function massDestroy(array $ids);

    /**
     * Trash the mass resources.
     */
    public function massTrash(array $ids);
}
