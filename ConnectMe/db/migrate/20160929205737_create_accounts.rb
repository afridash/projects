class CreateAccounts < ActiveRecord::Migration
  def up
    create_table :accounts do |t|
      t.string "first_name"
      t.string "last_name"
      t.string "email", :default => ""
      t.string "employee_id", :limit => 50
      t.string "hashed_password"
      t.timestamps
    end
  end
  def down
    drop_table :accounts
  end
end
