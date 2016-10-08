class LoginController < ApplicationController
  layout:false;
  def index
  end
  def attempt_login
    if params[:username].present? && params[:password].present?
      found_user = Account.where(:email => params[:username]).first
      if found_user
        authorized_user = found_user.authenticate(params[:password])
      end
      if authorized_user
        session[:user_id]=authorized_user.id
        session[:name]="#{authorized_user.first_name} #{authorized_user.last_name}"
        flash[:notice] = "You are now logged in. "
        redirect_to(:controller => 'dashboard')
      else
        flash[:notice]="Invalid username/password combination."
        redirect_to(:controller =>'login')
      end
    end
  end
  def logout
    session[:user_id]=nil
    session[:name]=nil
    flash[:notice]="Successfully logged out :)"
    redirect_to(:controller =>'login')
  end
end
