<?php

namespace App\Models\Traits\Attribute;

use Illuminate\Support\Facades\Hash;

/**
 * Trait PermissionAttribute.
 */
trait PermissionAttribute
{
    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.permissions.show', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.permissions.edit', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="javascript:;"
                style="cursor:pointer;"
                onclick="$(this).find(\'form\').submit();"
                title="' . __('buttons.general.crud.delete') . '"
                data-method="delete"
                data-trans-button-cancel="' . __('buttons.general.cancel') . '"
                data-trans-button-confirm="' . __('buttons.general.crud.delete') . '"
                data-trans-title="' . __('strings.backend.general.are_you_sure') . '"
                class="btn btn-danger">' .
            '<form action="' . route('admin.permissions.delete-permanently', $this) . '" method="GET" name="delete_item" style="display:none">'
            . '<input type="hidden" name="_method" value="delete" />'
            . '<input type="hidden" name="_token" value="' . csrf_token() . '" />'
            . '</form>' .
            '<i class="fas fa-trash"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeletePermanentlyButtonAttribute()
    {
        return '<a href="'.route('admin.permissions.delete-permanently', $this).'" name="confirm_item" class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.permissions.delete_permanently').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute()
    {
        return '<a href="'.route('admin.permissions.restore', $this).'" name="confirm_item" class="btn btn-info"><i class="fas fa-sync" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.permissions.restore').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '
    	<div class="btn-group" role="group" aria-label="'.__('labels.backend.permissions.actions').'">
		  '.$this->show_button.'
		  '.$this->edit_button.'
		  '.$this->delete_button.'
        </div>';
    }

    /**
     * @return string
     */
    public function getTrashedButtonsAttribute()
    {
        return '
            <div class="btn-group" role="group" aria-label="'.__('labels.backend.permissions.actions').'">
                '.$this->restore_button.'
                '.$this->delete_permanently_button.'
            </div>';
    }

    /**
     * @return string
     */
    public function getFrontendShowButtonAttribute()
    {
        return '<a href="'.route('frontend.permissions.show', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>';
    }

    /**
     * @return string
     */
    public function getFrontendEditButtonAttribute()
    {
        return '<a href="'.route('frontend.permissions.edit', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
    }

    /**
     * @return string
     */
    public function getFrontendDeleteButtonAttribute()
    {
        return '<a href="'.route('frontend.permissions.destroy', $this).'"
                title="'.__('buttons.general.crud.delete').'"
                data-method="delete"
                data-trans-button-cancel="'.__('buttons.general.cancel').'"
                data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
                data-trans-title="'.__('strings.backend.general.are_you_sure').'"
                class="btn btn-danger"><i class="fas fa-trash"></i></a> ';
    }

    /**
     * @return string
     */
    public function getFrontendDeletePermanentlyButtonAttribute()
    {
        return '<a href="'.route('frontend.permissions.delete-permanently', $this).'" name="confirm_item" class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.permissions.delete_permanently').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getFrontendRestoreButtonAttribute()
    {
        return '<a href="'.route('frontend.permissions.restore', $this).'" name="confirm_item" class="btn btn-info"><i class="fas fa-sync" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.permissions.restore').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getFrontendActionButtonsAttribute()
    {
        return '
    	<div class="btn-group" role="group" aria-label="'.__('labels.backend.permissions.actions').'">
		  '.$this->frontend_show_button.'
		  '.$this->frontend_edit_button.'
		  '.$this->frontend_delete_button.'
        </div>';
    }

    /**
     * @return string
     */
    public function getFrontendTrashedButtonsAttribute()
    {
        return '
            <div class="btn-group" role="group" aria-label="'.__('labels.backend.permissions.actions').'">
                '.$this->frontend_restore_button.'
                '.$this->frontend_delete_permanently_button.'
            </div>';
    }
}
