<div class="large-7 medium-8 small-12 columns">
  <div class="row">
    <div class="small-centered small-12 columns">
      <div class="action">
        <h1 class="subheader save">SAVE A</h1>
        <h1 class="a-mum">MUM</h1>

        
        <div class="message hide">
          <div class="row">
              <div class="large-3 small-4 columns">
                <img src="/images/flower.png" />
              </div>
              <div class="large-9 small-8 columns">
                <h4 class="subheader">Your Message</h4>
                <p class="text"></p>
                <div id="tweet-button"></div>
            </div>
          </div>
        </div>

        <div class="donation">
          <div class="prompt">
            <p>Thank you for your donation of KES 50. It will go a long way in helping to save a mum. Please enter a message to share on social media
            about why your mum is so special to you</p>

            <form method="POST" data-abide id="share_form">
              <textarea class="your_message" name="message" required></textarea>
              <small class="error">Please write a short message to share</small>
              <input type="hidden" name="user_donation_id" value="<?php if (isset($_SESSION['user_donation'])) echo $_SESSION['user_donation']['id']; else echo '' ?>" />
              <input type="submit" value="Send" class="button tiny" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>