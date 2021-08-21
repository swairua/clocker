<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    html {
        font-family: Arial, sans-serif;
        max-width: 500px;
        margin: auto;
        color: #666;
        }

        form {
        padding: 15px;
        border: 1px solid #666;
        background: #fff;
        display: none;
        }

        #formButton {
        display: block;
        margin-right: auto;
        margin-left: auto;
    }

</style>

<button type="button" id="formButton">Toggle Form!</button>
<form id="form1">
  <b>First Name:</b> <input type="text" name="firstName">
  <br><br>
  <b>Last Name: </b><input type="text" name="lastName">
  <br><br>
  <b> Age:</b>
  <br>
  <input type="radio" name="age" value="adolescent"> 0 - 19 years
  <br>
  <input type="radio" name="age" value="mid"> 20 - 59 years
  <br>
  <input type="radio" name="age" value="senior"> 60 + years
  <br> <br>
  <b>Preferred Color:</b>
  <select name="color">
    <option value="blue">Blue</option>
    <option value="green">Green</option>
    <option value="yellow">Yellow</option>
    <option value="red">Red</option>
    <option value="pink">Pink</option>
  </select>
  <br><br>
  <b>Comment:</b>
  <br>
  <textarea name="comment">
    Enter your comment here
  </textarea>
  <br><br>
  <button type="button" id="submit">Submit</button>
</form>
<script>
    $(document).ready(function() {
    $("#formButton").click(function() {
        $("#form1").toggle();
    });
    });
</script>