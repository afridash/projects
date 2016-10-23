class DashboardController < ApplicationController
  before_action :confirm_logged_in
  def index
    @user = Account.find(session[:user_id])
  end
  def show
    @team = params[:team]
    render 'show', :layout => false
  end
end
