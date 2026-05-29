<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create test user
        DB::table('users')->insertOrIgnore([
            'name' => 'Test User',
            'email' => 'test@bookstore.com',
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed books
        $books = [
            ['title' => 'Atomic Habits', 'author' => 'James Clear', 'category' => 'Self Help', 'price' => 125000, 'description' => 'Cara mudah membangun kebiasaan baik dan menghilangkan kebiasaan buruk.'],
            ['title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'category' => 'Novel', 'price' => 89000, 'description' => 'Kisah inspiratif anak-anak Belitung dalam meraih mimpi.'],
            ['title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'category' => 'Non Fiksi', 'price' => 145000, 'description' => 'Sejarah singkat umat manusia dari zaman purba hingga modern.'],
            ['title' => 'The Alchemist', 'author' => 'Paulo Coelho', 'category' => 'Novel', 'price' => 95000, 'description' => 'Novel filosofis tentang perjalanan seorang anak gembala meraih takdirnya.'],
            ['title' => 'Clean Code', 'author' => 'Robert C. Martin', 'category' => 'Pemrograman', 'price' => 185000, 'description' => 'Panduan menulis kode yang bersih, mudah dibaca, dan mudah dipelihara.'],
            ['title' => 'Dune', 'author' => 'Frank Herbert', 'category' => 'Fiksi Ilmiah', 'price' => 135000, 'description' => 'Epic science fiction tentang politik, agama, dan ekologi di planet gurun.'],
            ['title' => 'Rich Dad Poor Dad', 'author' => 'Robert Kiyosaki', 'category' => 'Self Help', 'price' => 99000, 'description' => 'Pelajaran tentang uang dan investasi dari dua perspektif berbeda.'],
            ['title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'category' => 'Novel', 'price' => 115000, 'description' => 'Karya monumental tentang perjuangan kemanusiaan di era kolonial.'],
            ['title' => 'Design Patterns', 'author' => 'Gang of Four', 'category' => 'Pemrograman', 'price' => 220000, 'description' => 'Pola-pola desain perangkat lunak yang telah teruji dan terbukti.'],
            ['title' => 'Thinking, Fast and Slow', 'author' => 'Daniel Kahneman', 'category' => 'Non Fiksi', 'price' => 155000, 'description' => 'Eksplorasi dua sistem berpikir manusia dan bagaimana keputusan dibuat.'],
            ['title' => 'Harry Potter dan Batu Bertuah', 'author' => 'J.K. Rowling', 'category' => 'Novel', 'price' => 105000, 'description' => 'Petualangan seorang penyihir muda di Hogwarts School of Witchcraft.'],
            ['title' => 'The Pragmatic Programmer', 'author' => 'David Thomas', 'category' => 'Pemrograman', 'price' => 195000, 'description' => 'Panduan komprehensif menjadi programmer yang handal dan profesional.'],
        ];

        foreach ($books as $book) {
            DB::table('books')->insertOrIgnore(array_merge($book, [
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
