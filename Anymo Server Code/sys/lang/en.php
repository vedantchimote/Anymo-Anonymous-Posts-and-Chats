<?php

    if (!defined("APP_SIGNATURE")) {

        header("Location: /");
        exit;
    }

	$TEXT = array();
	$SEX = array("Male" => 0, "Female" => 1);

    $TEXT['lang-code'] = "en";
    $TEXT['lang-name'] = "English";

    $TEXT['mode-demo'] = "Enabled demo version. The changes you've made will not be saved.";

    $TEXT['topbar-users'] = "Users";

    $TEXT['topbar-stats'] = "Statistics";

    $TEXT['topbar-signin'] = "Log in";

    $TEXT['topbar-logout'] = "Log out";

    $TEXT['topbar-signup'] = "Sign up";

    $TEXT['topbar-friends'] = "Friends";

    $TEXT['topbar-settings'] = "Settings";

    $TEXT['topbar-support'] = "Support";

    $TEXT['topbar-profile'] = "Profile";

    $TEXT['topbar-likes'] = "Notifications";

    $TEXT['topbar-search'] = "Search";

    $TEXT['topbar-main-page'] = "Home";

    $TEXT['topbar-wall'] = "Home";

    $TEXT['topbar-messages'] = "Messages";

    $TEXT['topbar-reports-to-users'] = "Complaints to members";

    $TEXT['topbar-live'] = "Posts stream";

    $TEXT['topbar-ad'] = "Ads";

    $TEXT['footer-about'] = "about";

    $TEXT['footer-terms'] = "terms";

    $TEXT['footer-contact'] = "contact us";

    $TEXT['footer-support'] = "support";

    $TEXT['footer-android-application'] = "Android app";

    $TEXT['page-main'] = "Main";

    $TEXT['page-ad'] = "Ads";

    $TEXT['page-users'] = "Users";

    $TEXT['page-hashtags'] = "Hashtags";

    $TEXT['page-reports-to-users'] = "Complaints to members";

    $TEXT['page-terms'] = "Terms and Policies";

    $TEXT['page-about'] = "About";

    $TEXT['page-language'] = "Choose your language";

    $TEXT['page-support'] = "Support";

    $TEXT['page-restore'] = "Password retrieval";

    $TEXT['page-restore-sub-title'] = "Please enter the email, on which registered page.";

    $TEXT['page-signup'] = "create account";

    $TEXT['page-login'] = "Login";

    $TEXT['page-login-sub-title'] = "Stay in touch on the go with QA Script mobile.";

    $TEXT['page-wall'] = "News";

    $TEXT['page-blacklist'] = "Blocked list";

    $TEXT['page-messages'] = "Messages";

    $TEXT['page-stream'] = "Stream";

    $TEXT['page-following'] = "Following";

    $TEXT['page-friends'] = "Friends";

    $TEXT['page-followers'] = "Followers";

    $TEXT['page-posts'] = "Posts";

    $TEXT['page-search'] = "Search";

    $TEXT['page-profile-report'] = "Report";

    $TEXT['page-profile-block'] = "Block";

    $TEXT['page-profile-upload-avatar'] = "Upload photo";

    $TEXT['page-profile-upload-cover'] = "Upload cover";

    $TEXT['page-profile-report-sub-title'] = "Reported profiles are sent to our moderators for a review. They will ban the reported profiles if they violate terms of use";

    $TEXT['page-profile-block-sub-title'] = "will not be able write comments to your Posts and send your messages, and you will not see notifications from";

    $TEXT['page-post-report-sub-title'] = "Reported posts are sent to our moderators for a review. They will removed the reported posts if they violate terms of use";

    $TEXT['page-likes'] = "People who like this";

    $TEXT['page-services'] = "Services";

    $TEXT['page-services-sub-title'] = "Connect My Social Network with your social network accounts";

    $TEXT['page-prompt'] = "create account or login";

    $TEXT['page-settings'] = "Settings";

    $TEXT['page-profile-settings'] = "Profile";

    $TEXT['page-profile-password'] = "Change password";

    $TEXT['page-notifications-likes'] = "Notifications";

    $TEXT['page-profile-deactivation'] = "Deactivate account";

    $TEXT['page-profile-deactivation-sub-title'] = "Leaving us?<br>If you proceed with deactivating your account, you can always come back. Just enter your login and password on the log-in page. We hope to see you again!";

    $TEXT['page-error-404'] = "Page not found";

    $TEXT['label-location'] = "Location";
    $TEXT['label-facebook-link'] = "Facebook page";
    $TEXT['label-instagram-link'] = "Instagram page";
    $TEXT['label-status'] = "Bio";

    $TEXT['label-error-404'] = "Requested page was not found.";

    $TEXT['label-account-disabled'] = "This user has disabled your account.";

    $TEXT['label-account-blocked'] = "This account has been blocked by the administrator.";

    $TEXT['label-account-deactivated'] = "This account is not activated.";

    $TEXT['label-reposition-cover'] = "Drag to Reposition Cover";

    $TEXT['label-or'] = "or";

    $TEXT['label-and'] = "and";

    $TEXT['label-signup-confirm'] = "By clicking Sign up, you agree to our";

    $TEXT['label-likes-your-post'] = "likes your post.";

    $TEXT['label-login-to-like'] = "You have to be a registered user to like posts.";

    $TEXT['label-login-to-follow'] = "You must have an account to follow this user.";

    $TEXT['label-empty-my-wall'] = "You haven't any posts yet.";

    $TEXT['label-empty-wall'] = "This user has no posts.";

    $TEXT['label-empty-page'] = "Here is empty.";

    $TEXT['label-empty-questions'] = "This is the link to your profile. Share it with your friends to get more followers.";

    $TEXT['label-empty-friends-header'] = "You have no friends.";

    $TEXT['label-empty-likes-header'] = "You have no notifications.";

    $TEXT['label-empty-list'] = "List is empty.";

    $TEXT['label-empty-feeds'] = "Here you'll see updates your friends.";

    $TEXT['label-search-result'] = "Search results";

    $TEXT['label-search-empty'] = "Nothing found.";

    $TEXT['label-search-prompt'] = "Find people by username.";

    $TEXT['label-thanks'] = "Hooray!";

    $TEXT['label-post-missing'] = "This post is missing.";

    $TEXT['label-post-deleted'] = "This post has been deleted.";

    $TEXT['label-posts-privacy'] = "Privacy settings for posts";

    $TEXT['label-comments-allow'] = "I authorize to comment on my posts";

    $TEXT['label-messages-privacy'] = "Privacy settings for messages";

    $TEXT['label-messages-allow'] = "Receive messages from anyone";

    $TEXT['label-settings-saved'] = "Settings saved.";

    $TEXT['label-password-saved'] = "Password successfully changed.";

    $TEXT['label-profile-settings-links'] = "And also you can";

    $TEXT['label-photo'] = "Photo";

    $TEXT['label-background'] = "Background";

    $TEXT['label-username'] = "Username";

    $TEXT['label-fullname'] = "Full name";

    $TEXT['label-services'] = "Services";

    $TEXT['label-blacklist'] = "Blocked list";

    $TEXT['label-blacklist-desc'] = "View blocked list";

    $TEXT['label-profile'] = "Profile";

    $TEXT['label-email'] = "Email";

    $TEXT['label-password'] = "Password";

    $TEXT['label-old-password'] = "Current password";

    $TEXT['label-new-password'] = "New password";

    $TEXT['label-change-password'] = "Change password";

    $TEXT['label-facebook'] = "Facebook";

    $TEXT['label-prompt-follow'] = "You must have an account to follow this user.";

    $TEXT['label-prompt-like'] = "You have to be a registered user to like posts.";

    $TEXT['label-placeholder-post'] = "Write your post ...";

    $TEXT['label-placeholder-message'] = "Write a message...";

    $TEXT['label-img-format'] = "Maximum size 3 Mb. JPG, PNG";

    $TEXT['label-message'] = "Message";

    $TEXT['label-subject'] = "Subject";

    $TEXT['label-support-message'] = "What are you contacting us about?";

    $TEXT['label-support-sub-title'] = "We are glad to hear from you! ";

    $TEXT['label-profile-info'] = "At the moment, there appears not all the information! All information is available from the application Sprosi.in for Android!";

    $TEXT['label-profile-report-reason-1'] = "This is spam.";

    $TEXT['label-profile-report-reason-2'] = "Hate Speech or violence.";

    $TEXT['label-profile-report-reason-3'] = "Nudity or Pornography.";

    $TEXT['label-profile-report-reason-4'] = "Fake profile.";

    $TEXT['label-profile-report-reason-5'] = "Piracy.";

    $TEXT['label-privacy'] = "Privacy";

    $TEXT['page-privacy'] = "Privacy policy";

    $TEXT['page-gdpr'] = "GDPR (General Data Protection Regulation) Privacy Rights";

    $TEXT['footer-gdpr'] = "GDPR";

    $TEXT['footer-privacy'] = "privacy policy";

    $TEXT['ticket-send-success'] = 'In a short time we will review your request and send a response to your email.';

    $TEXT['ticket-send-error'] = 'Please fill all fields.';

    $TEXT['label-cookie-message'] = "We use cookies to analyze our website traffic. By continuing to use the site, you agree to our ";

    $TEXT['label-errors-title'] = "Error. Read below:";

    // Actions

    $TEXT['action-send'] = "Send";

    $TEXT['action-back-to-main-page'] = "Return to main page";