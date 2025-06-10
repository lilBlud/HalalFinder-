Schema::create('certifications', function (Blueprint $table) {
    $table->id();
    $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
    $table->string('certification_body');
    $table->string('certificate_number');
    $table->date('issue_date');
    $table->date('expiry_date');
    $table->string('certificate_file_path');
    $table->boolean('is_approved')->default(false);
    $table->text('rejection_reason')->nullable();
    $table->timestamps();
});