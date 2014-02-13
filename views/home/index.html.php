<div class="large-7 large-offset-1 medium-8 small-12 columns">
  <div class="row">
    <div class="small-centered small-12 columns">
      <div class="action">
        <h1 class="subheader save">SAVE A</h1>
        <h1 class="a-mum">MUM</h1>

        <div class="social">
          <div class="row">
            <div class="large-3 columns">
              <a href="/twitter" class="tw"><img src="../../images/tw.png"></a>
            </div>
            <div class="large-3 columns">
              <a href="#" class="fb"><img src="../../images/fb.png"></a>
            </div>
            <div class="large-4 columns"></div>

          </div>
        </div>

        <div class="copy">
          <p>Donate as little as 50KES to buy a rose and save someone's loved one.</p>

          <p>Join, Participate and Engage to Make A Difference. Donations can be made to Mpesa Pay Bill 552817 or Chase Foundation Trustee a/c. 0082058777002.</p>
        </div>

        <div class="donation">
          <div class="row">
            <div class="small-12 small-centered columns">
              <p>Just one more step...Make a donation of at least 50KES, to Mpesa Pay Bill 552817 and enter your reference number below</p>
            </div>
          </div>
          <div class="row">
            <div class="small-12 small-centered columns">
              <form class="" action="/donate" method="POST" data-abide>
                <input type="text" name="mpesa_ref" placeholder="MPESA ref e.g EQ034K443 " required/>
                <input name="user_id" id="user_id" type="hidden" value="<?php if (isset($_SESSION['user'])) echo $_SESSION['user']['id']; else echo '' ?>" />
                
                <small class="error">Please enter a valid MPESA transaction reference</small>
                <input type="submit" value="Send" class="button tiny" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>