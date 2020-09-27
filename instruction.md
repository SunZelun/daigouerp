1. Create [object] migration file first

sample:
 
Schema::create('posts', function (Blueprint $table) {
    $table->increments('id');
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('perex')->nullable();
    $table->date('published_at')->nullable();
    $table->boolean('enabled')->default(false);
    $table->timestamps();
});

run: php artisan migrate

2. run: php artisan admin:generate [object] --seed(with fake data)

3. run: npm run dev
compose UI