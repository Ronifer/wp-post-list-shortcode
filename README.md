# wp-post-list-shortcode
Wordpress Shortcode to get a post list based on categories or tags

## Install
Copy all code lines to `/path/to/your/theme/folder/functions.php`

## Usage
[custom_post_list ...options]

## Options

| Option       | Required     | Value     |
| :------------- | :----------: | -----------: |
|  terms | yes   | String - List of all search terms separeted by semicolon  [Default: "cursos"]  |
| from   | yes | String - field to search values: ["category", "tag"]  [Default: "category"]  |
| limit   | no | Int - how many posts   |
| per_page   | no | Int - how many posts per page: [Default: 6]  |

##  Usage Example

###### Get just 3 posts filtered by `tag` where tag is `inspirações ou cursos ou ead`

`[custom_post_list terms="Inspirações;cursos;ead" from="tag"
limit="3"]`

###### Get 2 posts per page filtered by `category` where category is `cursos ou ead`

`[custom_post_list terms="cursos;ead" from="category" per_page="2"]`



