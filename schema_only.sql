
Table "categories" {
  "id" bigint [pk, not null, increment]
  "user_id" bigint [not null]
  "name" varchar(255) [not null]
    "color" varchar(7) [default: NULL]
  "created_at" timestamp [default: NULL]
  "updated_at" timestamp [default: NULL]


  Indexes {
    (user_id, name) [unique, name: "categories_user_id_name_unique"]
  }
}

Table "favorites" {
  "id" bigint [pk, not null, increment]
  "user_id" bigint [not null]
  "micropost_id" bigint [not null]
  "created_at" timestamp [default: NULL]
  "updated_at" timestamp [default: NULL]

  Indexes {
    (user_id, micropost_id) [unique, name: "favorites_user_id_micropost_id_unique"]
    micropost_id [name: "favorites_micropost_id_foreign"]
  }
}

Table "microposts" {
  "id" bigint [pk, not null, increment]
  "user_id" bigint [not null]
  "category_id" bigint [not null]
  "content" varchar(255) [not null]
  "created_at" timestamp [default: NULL]
  "updated_at" timestamp [default: NULL]

  Indexes {
    user_id [name: "microposts_user_id_foreign"]
    created_at [name: "microposts_created_at_index"]
    category_id [name: "microposts_category_id_index"]
  }
}

Table "user_follow" {
  "id" bigint [pk, not null, increment]
  "user_id" bigint [not null]
  "follow_id" bigint [not null]
  "created_at" timestamp [default: NULL]
  "updated_at" timestamp [default: NULL]

  Indexes {
    (user_id, follow_id) [unique, name: "user_follow_user_id_follow_id_unique"]
    follow_id [name: "user_follow_follow_id_foreign"]
  }
}

Table "users" {
  "id" bigint [pk, not null, increment]
  "name" varchar(255) [not null]
  "email" varchar(255) [not null]
  "email_verified_at" timestamp [default: NULL]
  "password" varchar(255) [not null]
  "remember_token" varchar(100) [default: NULL]
  "created_at" timestamp [default: NULL]
  "updated_at" timestamp [default: NULL]

  Indexes {
    email [unique, name: "users_email_unique"]
  }
}

Ref "categories_user_id_foreign":"users"."id" < "categories"."user_id" [delete: cascade]

Ref "favorites_micropost_id_foreign":"microposts"."id" < "favorites"."micropost_id" [delete: cascade]

Ref "favorites_user_id_foreign":"users"."id" < "favorites"."user_id" [delete: cascade]

Ref "microposts_category_id_foreign":"categories"."id" < "microposts"."category_id" [delete: restrict]

Ref "microposts_user_id_foreign":"users"."id" < "microposts"."user_id"

Ref "user_follow_follow_id_foreign":"users"."id" < "user_follow"."follow_id" [delete: cascade]

Ref "user_follow_user_id_foreign":"users"."id" < "user_follow"."user_id" [delete: cascade]

