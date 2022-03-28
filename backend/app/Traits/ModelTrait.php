<?php

namespace App\Traits;

use DB;
use Illuminate\Database\Eloquent\Builder;
use Schema;


/**
 * Trait ModelTrait
 * @package App\Traits
 * @method void|static search($query)
 */
trait ModelTrait
{



	public function persist($data, $save = true)
	{
		foreach ($data as $key => $value)
		{
			$this->$key = $value;
		}

		if ($save)
		{
			$this->save();
		}

		return $this;
	}

	/**
	 * @param $query
	 * @param $s
	 *
	 * @return mixed
	 */
	public function scopeSearch(Builder $query, $s)
	{
		if (!$s || $s == '')
		{
			return $query;
		}
		if ($this->search_fields)
		{
			$column = $this->search_fields;
		}
		else
		{
			$column = Schema::getColumnListing($this->getTable());
		}
		foreach ($column as $key => $c)
		{
			if (is_array($c))
			{
				$relation = $c;
				$query->orWhereHas($c[0], function ($q) use ($relation, $s)
				{
					foreach ($relation[1] as $key => $column)
					{
						if ($key)
							$q->orWhere($column, 'LIKE', '%' . $s . '%');
						else
							$q->where($column, 'LIKE', '%' . $s . '%');
					}
				});
			}
			else
			{
				if ($key)
					$method='orWhere';
				else
					$method='where';

				if($c==='full_name')
					$c=DB::raw('CONCAT(first_name," ",last_name)');

					$query->$method($c, 'LIKE', '%' . $s . '%');
			}
		}

		return $query;

	}

	public function scopeActive($q, $s)
	{
		if (!is_null($s) && $s == '1' || $s == '0')
		{
			$q->where('active', $s);
		}

		return $q;
	}

	public function scopeSort($q, $orderBy, $orderDirection)
	{

		return $q->orderBy($orderBy, $orderDirection);
	}

	public function scopeFindByArgs($q, $args)
	{
		if (is_array($args) && count($args))
			foreach ($args as $column => $value)
				$q->where($column, $value);

	}

	public function scopeFilterByPatient($query, $patient)
	{
		if ($patient)
			$query->where('patient_id', $patient);
	}
}