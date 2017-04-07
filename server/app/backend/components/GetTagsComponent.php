<?php

/**
 * This class can be used to get the most common colors in an image.
 * It needs one parameter:
 * 	$image - the filename of the image you want to process.
 * Optional parameters:
 *
 * 	$count - how many colors should be returned. 0 mmeans all. default=20
 * 	$reduce_brightness - reduce (not eliminate) brightness variants? default=true
 * 	$reduce_gradients - reduce (not eliminate) gradient variants? default=true
 * 	$delta - the amount of gap when quantizing color values.
 * 		Lower values mean more accurate colors. default=16
 *
 * Author: 	Csongor Zalatnai
 *
 * Modified By: Kepler Gelotte - Added the gradient and brightness variation
 * 	reduction routines. Kudos to Csongor for an excellent class. The original
 * 	version can be found at:
 *
 * 	http://www.phpclasses.org/browse/package/3370.html
 *
 */

namespace backend\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class GetTagsComponent extends Component {

    /**
     * Returns the colors of the image in an array, ordered in descending order, where the keys are the colors, and the values are the count of the color.
     *
     * @return array
     */
    function Get_Tag($image_url) {

/*        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://api.clarifai.com/v1/token/',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                'client_id' => '9nxu--dC2-nTdJzKP8Z1eEGEqY8U55F0Ob3r3-PD',
                'client_secret' => 'X1MxpBmp0Ct6k4ujbaUarV9IiFmMtjVsjXqlY_Ge',
                'grant_type' => 'client_credentials'
            )
        ));
        $resp = curl_exec($curl);
        curl_close($curl);
        $access_token = json_decode($resp);
        $api_tag_url = 'https://api.clarifai.com/v1/tag/?access_token=' . $access_token->access_token . '&url=' . $image_url;

        $data_json = file_get_contents($api_tag_url);*/
/*
        if (json_decode($data_json)->status_code == 'OK') {
            return json_decode($data_json)->results[0]->result->tag->classes;
        } else {
            return FALSE;
        }*/

        return false;
    }

}
