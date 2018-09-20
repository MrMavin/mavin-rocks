<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $array = parent::toArray($request);

        if (isset($array['tags'])){
            $tags = '';
            foreach ($array['tags'] as $tag) {
                $tags .= $tag['tag'].',';
            }
            $array['tags'] = trim($tags, ',');
        }

        if ($array['category_id'] == null){
            $array['category_id'] = "";
        }

        return $array;
    }
}
