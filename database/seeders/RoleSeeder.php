<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Roles

        $adminRole = Role::create(['name' => 'admin']); // Admin Rolü
        $writerRole = Role::create(['name' => 'writer']); // Yazar Rolü
        $userRole = Role::create(['name' => 'user']); // Kullanıcı Rolü
        $guestRole = Role::create(['name' => 'guest']); // Misafir Rolü

        // Permissions

        $auth_Permission = Permission::create(['name' => 'auth']); // Kayıt OLma ve Giriş Yapma
        $browseBlogHomepage_Permission = Permission::create(['name' => 'browse-blog-homepage']); // Blogu Görüntüleme

        $browseArticles_Permission = Permission::create(['name' => 'browse-articles']); // Makaleleri Görüntüleme
        $browseComments_Permission = Permission::create(['name' => 'browse-comments']); // Yorumları Görüntüleme
        $comment_Permission = Permission::create(['name' => 'comment']); // Yorum Yapma
        $like_Permission = Permission::create(['name' => 'like']); // Beğeni Yapma
        $likeComment_Permission = Permission::create(['name' => 'like-comment']); // Yorum Beğenme
        $commentToComment_Permission = Permission::create(['name' => 'comment-to-comment']); // Yorumlara Yorum Yapma
        $likeHashtag_Permission = Permission::create(['name' => 'like-hashtag']); // Etiket Beğenme

        $createArticle_Permission = Permission::create(['name' => 'create-article']); // Makale Oluşturma
        $editArticle_Permission = Permission::create(['name' => 'edit-article']); // Makale Düzenleme
        $deleteArticle_Permission = Permission::create(['name' => 'delete-article']); // Makale Silme
        $addHashtagToArticle_Permission = Permission::create(['name' => 'add-hashtag-to-article']); // Makaleye Etiket Ekleme
        $editHashtagToArticle_Permission = Permission::create(['name' => 'edit-hashtag-to-article']); // Makalede Etiket Düzenleme
        $deleteHashtagToArticle_Permission = Permission::create(['name' => 'delete-hashtag-to-article']); // Makaleden Etiket Silme
        $editProfile_Permission = Permission::create(['name' => 'edit-profile']); // Profil Düzenleme

        $addHashtag_Permission = Permission::create(['name' => 'add-hashtag']); // Etiket Ekleme
        $editHashtag_Permission = Permission::create(['name' => 'edit-hashtag']); // Etiket Düzenleme
        $deleteHashtag_Permission = Permission::create(['name' => 'delete-hashtag']); // Etiket Silme
        $editUsers_Permission = Permission::create(['name' => 'edit-users']); // Kullanıcıları Düzenleme
        $deleteUsers_Permission = Permission::create(['name' => 'delete-users']); // Kullanıcıları Silme
        $giveRole_Permission = Permission::create(['name' => 'give-role']); // Kullanıcılara Rol Verme
        $editHomepageSlider_Permission = Permission::create(['name' => 'edit-homepage-slider']); // Anasayfa Slider'ı Düzenleme
        $editBlogHomepageFeed_Permission = Permission::create(['name' => 'edit-blog-homepage-feed']); // Blog Anasayfa Akışını Düzenleme

        // Assign Permissions to Roles

        $adminRole->givePermissionTo([
            $auth_Permission,
            $browseBlogHomepage_Permission,
            $browseArticles_Permission,
            $browseComments_Permission,
            $comment_Permission,
            $like_Permission,
            $likeComment_Permission,
            $commentToComment_Permission,
            $likeHashtag_Permission,
            $createArticle_Permission,
            $editArticle_Permission,
            $deleteArticle_Permission,
            $addHashtagToArticle_Permission,
            $editHashtagToArticle_Permission,
            $deleteHashtagToArticle_Permission,
            $editProfile_Permission,
            $addHashtag_Permission,
            $editHashtag_Permission,
            $deleteHashtag_Permission,
            $editUsers_Permission,
            $deleteUsers_Permission,
            $giveRole_Permission,
            $editHomepageSlider_Permission,
            $editBlogHomepageFeed_Permission
        ]);

        $writerRole->givePermissionTo([
            $auth_Permission,
            $browseBlogHomepage_Permission,
            $browseArticles_Permission,
            $browseComments_Permission,
            $comment_Permission,
            $like_Permission,
            $likeComment_Permission,
            $commentToComment_Permission,
            $likeHashtag_Permission,
            $createArticle_Permission,
            $editArticle_Permission,
            $deleteArticle_Permission,
            $addHashtagToArticle_Permission,
            $editHashtagToArticle_Permission,
            $deleteHashtagToArticle_Permission,
            $editProfile_Permission
        ]);

        $userRole->givePermissionTo([
            $auth_Permission,
            $browseBlogHomepage_Permission,
            $browseArticles_Permission,
            $browseComments_Permission,
            $comment_Permission,
            $like_Permission,
            $likeComment_Permission,
            $commentToComment_Permission,
            $likeHashtag_Permission
        ]);

        $guestRole->givePermissionTo([
            $auth_Permission,
            $browseBlogHomepage_Permission
        ]);
    }
}
