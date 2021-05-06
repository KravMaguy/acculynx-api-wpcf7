<?php
include 'secrets.php';
add_action( 'wp_head', 'cf7_form_send_to_acculynx' );

function cf7_form_send_to_acculynx() { 
    // YOUR JAVASCRIPT CODE GOES BELOW 
    ?>
<script>
	document.addEventListener("wpcf7mailsent", function (event) {
  const details = event.detail.inputs;
  const name = details[0].value;
  const email = details[1].value;
  const phone = details[2].value;
  const address = details[3].value;
  const message = details[4].value;
  const key=<?=$apiKey;?>
  console.log("name: ", name);
  console.log("email: ", email);
  console.log("phone: ", phone);
  console.log("address: ", address);
  console.log("message: ",message)
  const url="https://api.acculynx.com/api/v1/leads"
fetch(url, {
  headers: { "Content-Type": "application/json; charset=utf-8", "Authorization": "Bearer "+key, "mode": "no-cors", },
  method: 'POST',
  body: JSON.stringify({
        firstName: name,
        emailAdress: email,
        phoneNumber1: phone,
        jobCategory: "residential",
        street: address,
        notes: message,
      })
})
  .then(response => response.json())
  .then(success => {
    console.log(success);
  })
.catch(err => console.log(err))
});
</script>
    <?php
}