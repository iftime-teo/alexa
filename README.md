Still has to be done (digged a little, but couldn't find how to do it or didn't worked how i wanted to):
    - handle errors in register and login page (especially in register page);
    - pagination for homepage and courses page - the button is there when it needs to be, but has no functionality yet;
    - the notifications are static. I don't know what notifications (or where to get them from) was i supposed to implement;
    - the responsiveness needs to be reviewed (almost nothing done there);
    - SEO needs to be reviewed. In terms of page loading time, i tried to keep my code simple and clear, so i guess that there's the only touched SEO area.

Unclear requests:
    - the image for homepage contains 6 "courses" with thumbnail, title and description. The confusing part is that in the courses page, the "course" description has something different. I chose that the content will go below the "banner", then continued with the Chapter listing;
    - the notifications, as i mentioned above, are written "by hand", so the functionality will be, most probably, implemented after clearing the notifications origin.
    
    Sidenote: haven't used any js scripts in the theme;
    
FUNCTIONALITY:

- the courses in the homepage can be added by simply adding a POST with category "course";
- the course chapters can be added by simply adding a POST with category "chapter" - maybe i should've made categories and subcategories for every course and chapters, so each course will have their own chapters;
- if the POSTs number containing the category "course" is bigger then 6, the button "discover more" will apear. Fewer post => no button;
- if the POSTs number containing the category "chapter" is bigger then 4, the button "See the full curriculum" will be displayed; fewer => just the POSTs;
- if the user is logging in, in the top right corner a "Login" link will be displayed, clicking the link, the user is redirected to the custom made login page. If the user enters a invalid email/password, an error message colored in red will be displayed under the "Login to your account" text, displaying what needs to be corrected. - the placeholders need to be added;
- if the user has no account, he can press the "sign up" button from the button of login page, gets redirected to the register page where he can create an account. - if the user doesn't fills all the fields, he's redirected to a weird looking page (Wordpress' login/register/recover page, but messed up). But, if the users fills the fileds as it should be, the account is created and he's redirected to login page where he can start his jorney by entering the just typed in the register form credentials, in the login form. Once he entered valid informations, he's redirected to homepage.
