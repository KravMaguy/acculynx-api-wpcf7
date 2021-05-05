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
  (async () => {
    const rawResponse = await fetch("https://api.acculynx.com/api/v1/leads", {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        'Authorization': 'Bearer '+key, 
      },
      body: JSON.stringify({
        firstName: name,
        emailAdress: email,
        phoneNumber1: phone,
        jobCategory: "residential",
        street: address,
        notes: message,
      }),
    });
    const content = await rawResponse.json();

    console.log("server response: ", content);
  })();
});
</script>
    <?php
}