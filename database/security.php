<!-- THIS PAGE WILL BE USED TO STORE ALL THE LINES OF CODE I THINK WILL BE HELPFUL IN MAINTING THE SECURITY OF THE WEBSITE
    EVERYTHING I DEEM USEFUL BUT DONT USE RIGHT AWAY WILL BE IN THIS FILE FOR EASY ACCESS

"filter input, encode output"


PREVENTING CROSS-SITE SCRIPTING XSS 

Validate: If the input contains unexpected characters reject it:

if ( !preg_match ("/^[a-zA-Z\s]+$/", $_GET['name'])) {
  // ERROR: Name can only contain letters and spaces
}




Encode: When showing untrusted data encode it first using htmlspecialchars() or htmlentities():

<?=htmlentities($post['text'])?>      //encodes all characters
<?=htmlspecialchars($post['text'])?>  //encodes only special chars




Encode: When using untrusted data to create URLs encode it first using urlencode():

<a href="search.php?q=<?=urlencode($_GET['q'])?>">



HTML Escape Before Inserting Untrusted Data into HTML Element Content

const entityMap = {
  "&": "&amp;",
  "<": "&lt;",
  ">": "&gt;",
  '"': '&quot;',
  "'": '&#39;',
  "/": '&#x2F;'
};
function escapeHtml(string) {
  return String(string).replace(/[&<>"'\/]/g, function (s) {
    return entityMap[s];
  });
}



To mitigate the impact of an XSS flaw on your site, set the HTTPOnly flag 
on your session cookie using session-set-cookie-params before starting your session:

    session_set_cookie_params(0, '/', 'www.fe.up.pt', true, true);




PREVENTING CROSS-SITE REQUEST FORGERY

Generate a random token per session
Store this token as a session variable
Send this token as part of every (sensitive) request
Verify the token is correct on every page

function generate_random_token() {
  return bin2hex(openssl_random_pseudo_bytes(32));
}
session_start();
if (!isset($_SESSION['csrf'])) {
  $_SESSION['csrf'] = generate_random_token();
}
<form action="transfer.php">
  <input type="hidden" name="csrf" value="<?=$_SESSION['csrf'])?>">
</form>
session_start();
\\...
if ($_SESSION['csrf'] !== $_POST['csrf']) {
  // ERROR: Request does not appear to be legitimate
}




-->