<?php

/**
 *
     $result = DB::table('rooms')->where([
           ['price', '<', 200],
           ['room_size', 2]
       ])->get();
===============================================================================================
    $result = DB::table('rooms')->where('price', '<', 400)
    ->orWhere(function($query) {
    $query->where('room_size', '>', 1)->where('room_size', '<', '4');
    })->get();

===============================================================================================
    $result = DB::table('users')->whereMonth('created_at', '4')->get();
    $result = DB::table('users')->whereExists(function ($query) {
    $query->select('id')
    ->from('posts')
    ->whereRaw('posts.id = users.id')->whereBetween('id', [1, 2]);
    })->get();
===============================================================================================
    $result = DB::table('posts')->whereJsonContains('meta->skills', 'html')->get();
    DB::statement('ALTER TABLE posts ADD FULLTEXT key(description)');
    DB::statement('alter table posts ADD FULLTEXT key(column_name )')
    $result = DB::table('posts')->whereRaw("MATCH(description) AG AGINST (? IN BOOLEAN MODE)", ['Voluptatem'])->get();
    $result = DB::table('posts')->where('description', 'like', '%Voluptatem%');
===============================================================================================
    $result = DB::table('posts')
    // ->where("content", 'like', '%inventore%')
    ->whereRaw("content LIKE '%inventore%'") // be careful about SQL injections!
    // ->where(DB::raw("content LIKE '%inventore%'")) // not working because where() needs two parameters
    ->get();
===============================================================================================
    $result = DB::table('posts')
    // ->select(DB::raw('count(user_id) as number_of_posts, users.name'))
    ->selectRaw('count(user_id) as number_of_posts, users.name',[])
    ->join('users','users.id','=','posts.user_id')
    ->groupBy('user_id')
    ->get();
===============================================================================================

    whereRaw / orWhereRaw
    havingRaw / orHavingRaw
    orderByRaw
    groupByRaw

    $result = DB::table('posts')
    ->orderByRaw('updated_at - created_at DESC')
    ->get();


    $result = DB::table('users')
    ->selectRaw('LENGTH(name) as name_lenght, name')
    ->orderByRaw('LENGTH(name) DESC')
    ->get();
===============================================================================================
 * https://deliciousbrains.com/optimizing-laravel-database-indexing-performance/
EXPLAIN SELECT * FROM `tasks` WHERE `tasks`.`user_id` = 1 AND `tasks`.`user_id` IS NOT NULL
Schema::table('tasks', function (Blueprint $table) {
$table->index('user_id');
});
===============================================================================================
 * GROUP BY - LIMIT - OFFSET - ORDERBY *
 $result = DB::table('users')
             ->orderBy('name', 'desc')
             ->get();

 $result = DB::table('users')
             ->latest() // created_at default
             ->first();

 $result = DB::table('users')
             // ->inRandomOrder()
             ->orderByRaw('RAND()')
             ->first();

 $result = DB::table('comments')
             ->selectRaw('count(id) as number_of_5stars_comments, rating')
             ->groupBy('rating')
             ->having('rating', '=', 5)
             ->get();

 $result = DB::table('comments')
             ->skip(5)
             ->take(5)
             ->get();

$result = DB::table('comments')
->offset(5)
->limit(5)
->get();

dump($result);
===============================================================================================

 *
 *
 *
 *
 *
 *
 *
 */









