class AddPasswordDigestToAccounts < ActiveRecord::Migration
  def up
  remove_column "accounts", "hashed_password"
  add_column "accounts", "password_digest", :string
  end
  def down
    remove_column "accounts", "password_digest"
    add_column "accounts", "hashed_password", :string
  end
end
