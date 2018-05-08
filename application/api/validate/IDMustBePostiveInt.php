<?php
	namespace app\api\validate;

	class IDMustBePostiveInt extends BaseValidate{


		protected $rule = [
						'id' => 'require|isPositiveInteger'
					];
        protected $message = [
            'id' => 'id必须是正整数'
        ];
	}