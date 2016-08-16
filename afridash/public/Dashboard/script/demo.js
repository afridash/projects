/* globals hopscotch: false */

/* ============ */
/* EXAMPLE TOUR */
/* ============ */
var tour = {
  id: 'hello-hopscotch',
  steps: [
    {
      target: 'TopToggleHead',
      title: 'Toggle Side Menu!',
      content: 'Click on this button to hide or show the side menu.',
      placement: 'bottom',
      arrowOffset: 260
    },
    {
      target: 'SearchSite',
      placement: 'bottom',
      title: 'Search',
      content: 'You can search for coursemates, friends, and professors here.',
        arrowOffset: 50
    },
    {
      target: 'NewsUpdateBox',
      placement: 'bottom',
      title: 'News Update Box!',
      content: 'News and important information flashes here from your school. So be on the lookout for this.',
        arrowOffset: 50,
      yOffset: -25
    },
    {
      target: 'friends_li',
      placement: 'bottom',
      title: 'Friends Notification Icon',
      content: 'This is where notifications of new friend requests and those who accept your requests will pop up. Be on the look out!!.',
      arrowOffset: 5,
      yOffset: -25
    },
    {
      target: 'notification_li',
      placement: 'bottom',
      title: 'Notification Icon',
      content: 'Notifications about your posts and those of your friends appear here. Likes and comments on your posts and those of your friends also appear here.',

    },
    {
      target: 'messages_link',
      placement: 'bottom',
      title: 'Message Notification Icon',
      content: 'This icon notifies you of messages from friends and course mates.',
        arrowOffset: 10
    },
      {
      target: 'tasks_li',
      placement: 'left',
      title: 'Tasks Icon',
      content: 'This icon notifies you of tasks such as tests and assignments posted by faculty',
        arrowOffset: 10
    },
      
      {
      target: 'adakaprofile',
      placement: 'left',
      title: 'Profile Icon',
      content: 'This icon represents your profile and will have your proile picture once you set that up. It also has some icons for navigating the site.',
        arrowOffset: 10
    },
      
      {
      target: 'panoramicview',
      placement: 'right',
      title: 'The Dashboard',
      content: 'You are on the dashboard now. This is your first spot of call once you login. It gives you a panoramic view of the site.',
        arrowOffset: 10
    },
      
      {
      target: 'bayelsagrade',
      placement: 'right',
      title: 'Grades!!',
      content: 'This button takes you to the page where grades can be posted. Grades will be posted for midterms and finals.',
        arrowOffset: 10
    },
      
      {
      target: 'yenagoapresent',
      placement: 'right',
      title: 'Class Roster!!',
      content: 'This button leads you to the page to take attendance. Students can be marked as present, absent, tardy, and or excused!',
        arrowOffset: 10
    },
      
      {
      target: 'bossmail',
      placement: 'right',
      title: 'Your Email Portal!',
      content: 'This tab takes you to the email portal where the normal operations of checking emails, creating and deleting mails can be done!',
        arrowOffset: 10
    },
      
      {
      target: 'iguniweilab',
      placement: 'right',
      title: 'Laboratory Simulations!',
      content: 'This module has laboratory simulations for fundamental concepts in Physics, Chemistry, Biology and e.t.c!',
        arrowOffset: 10
    },
      
      {
      target: 'igbirikipadimen',
      placement: 'right',
      title: 'Friends and Associates!',
      content: 'This module shows you a list of your friends and associates which may include your students and colleagues!!',
        arrowOffset: 10
    },
      
      {
      target: 'ogirikiforums',
      placement: 'right',
      title: 'Forums!',
      content: 'This module has forums grouped according to courses and topics of interests. You can keep a tab of topics that interests you!!',
        arrowOffset: 10
    },
      
      {
      target: 'perewarilendar',
      placement: 'right',
      title: 'Calendar/Planner!',
      content: 'This is not your average calendar. You can customize it into a daily planner!',
        arrowOffset: 10
    },
      
      {
      target: 'futureplan',
      placement: 'right',
      title: 'Your Transcript',
      content: 'This button takes you to the page where you can start the process of ordering your unofficial and/or official transcripts.',
        arrowOffset: 10
    },
      
      {
      target: 'classReg',
      placement: 'right',
      title: 'Class Registration Button',
      content: 'This button takes you to the page where you can search and register for courses.',
        arrowOffset: 10
    },
      
      {
      target: 'okuberimail',
      placement: 'right',
      title: 'Grades',
      content: 'Check you grades per semester',
        arrowOffset: 10
    },
      
      {
      target: 'ikulabs',
      placement: 'right',
      title: 'Laboratory Simulations',
      content: 'Laboratory simulations for fundamental concepts in science subjects like math, physics, chemistry, and e.t.c are available in this section.',
        arrowOffset: 10
    },
      {
      target: 'pereforums',
      placement: 'right',
      title: 'Forums, Friends-Connect',
      content: 'This sections is where you conncect with friends, follow topics that interests you, and you might be able to connect with your professors here too.',
        arrowOffset: 10
    },
      
      {
      target: 'yingifriends',
      placement: 'right',
      title: 'Friends Zone!',
      content: 'This button shows you your list of friends. Clicking on anyone takes you to his or her profile.',
        arrowOffset: 10
    },
      
      {
      target: 'uzomacalender',
      placement: 'right',
      title: 'Calendar!',
      content: 'This calendar comes with preloaded important dates from your school. It also has features for you add whatever information you may need.',
        arrowOffset: 10
    },
      
  ],
  showPrevButton: true,
  scrollTopMargin: 100
},

/* ========== */
/* TOUR SETUP */
/* ========== */
addClickListener = function(el, fn) {
  if (el.addEventListener) {
    el.addEventListener('click', fn, false);
  }
  else {
    el.attachEvent('onclick', fn);
  }
},

init = function() {
  var startBtnId = 'StartTour',
      calloutId = 'startTourCallout',
      mgr = hopscotch.getCalloutManager(),
      state = hopscotch.getState();

  if (state && state.indexOf('hello-hopscotch:') === 0) {
    // Already started the tour at some point!
    hopscotch.startTour(tour);
  }

    if (!hopscotch.isActive) {
      mgr.removeAllCallouts();
      hopscotch.startTour(tour);
    }
};

