<?php

if (!function_exists('checkPerm')) {
	/**
	 * Check Permision Role using Entrust
	 * @param string $name
	 */
	function checkPerm($name = '', $show_abort = false)
	{
        return true;
		if($show_abort) {
			if(!auth()->user()->can($name)) {
				abort(401);
			}
		} else {
			return auth()->user()->can($name) ? true : false;
		}
	}
}

if (!function_exists('setAlert')) {
	/**
	 * Set Notif Alert
	 * @param string $type
	 * @param string $message
	 */
	function setAlert($type = 'warning', $message = '')
	{
		$data = [
			'type'    => $type,
			'message' => $message
		];

		return session()->flash('notif_alert', $data);
	}
}

if (!function_exists('format_money')) {
	/**
 	* Format money
 	* @param int $number
 	* @param string $currency
 	* @param bool $ceil
 	* @return string
 	*/
	function format_money($number, $currency = 'Rp', $ceil = true)
	{
		if ($ceil) {
			$number = ceil($number);
		}
		return "{$currency} " . number_format($number, 2, ',', '.');
	}
}

if (!function_exists('setting')) {
	/**
 	* Get setting
 	* @param string $key
 	* @param string $field
 	* @return mixed
 	*/
	function setting($key, $field = 'value')
	{
		$setting = \Cache::remember("setting.$key", 1, function () use ($key) {
			return \App\Models\Setting::where('key', $key)->first();
		});
		return optional($setting)->{$field};
	}
}

if (!function_exists('array_keys_exist')) {
	function array_keys_exist($keys, $array) {
		$array_keys = array_keys($array);
		return count(array_diff($keys, $array_keys)) == 0;
	}
}

if (!function_exists('array_keys_filled')) {
	function array_keys_filled($keys, $array) {
		foreach ($keys as $key) {
			if (!isset($array[$key]) || ((string) $array[$key]) == '') return false;
		}
		return true;
	}
}

/**
 * Check User Privilege
 * @param string $name
 */
function checkPriv($name = '', $show_abort = false)
{
    if($show_abort) {
        if(!auth()->user()->ableTo($name)) {
            abort(401);
        }
    } else {
        return auth()->user()->ableTo($name) ? true : false;
    }
}

if (!function_exists('split_name')) {
    /**
     * Split Name
     *
     * @param   string  $name  name
     *
     * @return  array         array of name
     */
    function split_name($name)
    {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
        return array($first_name, $last_name);
    }
}

if (!function_exists('does_url_exists')) {
    function does_url_exists($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($code == 200) {
            $status = true;
        } else {
            $status = false;
        }
        curl_close($ch);
        return $status;
    }
}

if (!function_exists('abbr')) {
    /**
     * Build Acronym
     *
     * @param   string  $str
     *
     * @return  string        [return abbr]
     */
    function abbr($str)
    {
        $v = preg_replace("/[^A-Za-z0-9 ]/", "", $str);
        if(preg_match_all('/\b(\w)/',strtoupper($v),$m)) {
            $v = implode('',$m[1]); // $v is now SOQTU
        }

        return strtoupper($v);
    }
}

if (!function_exists('getEmailDomain')) {
    /**
     * Get domain from email address
     *
     * @param   string  $email
     *
     * @return  string        [return domain]
     */
    function getEmailDomain($email)
    {
        if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
            // split on @ and return last value of array (the domain)
            $domain = explode('@', $email);

            // output domain
            return $domain[1] ?? '';
        }
    }
}

if (!function_exists('paginateCollection')) {
    function paginateCollection($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (\Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof \Illuminate\Support\Collection ? $items : \Illuminate\Support\Collection::make($items);
        return new \Illuminate\Pagination\LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}

if (!function_exists('rupiah')) {
    /**
     * Get rupiah format
     *
     * @param   integer  $email
     *
     * @return  string        [return rp format]
     */
    function rupiah($number)
    {
        return 'Rp '.number_format($number, 0, ',', '.');
    }
}

if (!function_exists('dayHour2Minute')) {
    /**
     * Get rupiah format
     *
     * @param   integer  $email
     *
     * @return  string        [return rp format]
     */
    function dayHour2Minute($day, $hour, $minute)
    {
        return ($day*24*60)+($hour*60)+$minute;
    }
}

if (!function_exists('isTrueValueRequest')) {
    /**
     * Get valuable boolean
     *
     * @param   \Illuminate\Http\Request  $request
     * @param   string  $key
     *
     * @return  bool
     */
    function isTrueValueRequest($request, $key): bool
    {
        if (!isset($request[$key]))
            return false;

        if ($request[$key] === 'true' || $request[$key] === 'True' || $request[$key] == 1)
            return true;
        else
            return false;
    }
}
