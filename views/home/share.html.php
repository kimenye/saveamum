<div class="large-7 medium-8 small-12 columns">
  <div class="row">
    <div class="small-centered small-12 columns">
      <div class="action">
        <h1 class="subheader save">SAVE A</h1>
        <h1 class="a-mum">MUM</h1>

        


        <div class="donation">
          <div class="prompt">
            <p>Thank you for your donation of KES 50. It will go a long way in helping to save a mum. Please enter a message to share on social media
            about why your mum is so special to you</p>

            <form method="POST" data-abide id="share_form">
              <textarea name="message" required></textarea>
              <small class="error">Please write a short message to share...</small>
              <input type="hidden" name="user_donation_id" value="<?php if (isset($_SESSION['user_donation'])) echo $_SESSION['user_donation']['id']; else echo '' ?>" />
              <input type="submit" value="Send" class="button tiny" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>