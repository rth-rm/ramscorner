  <title>Add Devices | RAMS Corner</title>
    <!-- <link rel="stylesheet" href="style.css" /> -->
        <!---internal CSS--->
<style>

@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  background: #f6f7FB;
}
.container {
  position: relative;
  max-width: 700px;
  width: 100%;
  background: #fff;
  padding: 25px;
  border-radius: 25px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

.container .title{
    font-size: 27px;
    font-weight: bold;
    position: relative;
    color: #242934;
}
/* title highlight */
.container .title::before{ 
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    height: 3px;
    width: 57px;
    background: linear-gradient(135deg, #6644a8, #05e0e9)
}
/* .container header { 
  font-size: 1.5rem;
  color: #333;
  font-weight: 500;
  text-align: center;
} */

.container .form {
  margin-top: 30px;
}
.form .input-box {
  width: 100%;
  margin-top: 20px;
}
.input-box label {
  color: #333;
}
.form :where(.input-box input, .select-box) {
  position: relative;
  height: 50px;
  width: 100%;
  outline: none;
  font-size: 1rem;
  color: #817e9d;
  margin-top: 8px;
  border: 1px solid #ddd;
  border-radius: 25px;
  padding: 0 15px;
}
.input-box input:focus {
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
}
.form .column {
  display: flex;
  column-gap: 15px;
}
.form .device-type{
  margin-top: 20px;
}
/*
.device-box h3 {
  color: #817e9d;
  font-size: 1rem;
  font-weight: 400;
  margin-bottom: 8px;
}*/

.form :where(.device-option, .device) {
  display: flex;
  align-items: center;
  column-gap: 50px;
  flex-wrap: wrap;
  margin-top: 5px;
}
.form .device {
  column-gap: 5px;
}
.device input {
  accent-color: #817e9d;
}
.form :where(.device input, .device label) {
  cursor: pointer;
}
.device label {
  color: #707070;
}
.address :where(input, .select-box) {
  margin-top: 15px;
}
.select-box select {
  height: 100%;
  width: 100%;
  outline: none;
  border: none;
  color: #707070;
  font-size: 1rem;
}
/*buttons*/
.form .buttons {
  display: flex;
  column-gap: 5px;
  margin-top: 40px;
}
.add-btn{
  height: 55px;
  width: 50%;
  color: #fff;
  font-size: 1rem;
  font-weight: 400;
  border: none;
  border-radius: 25px;
  cursor: pointer;
  transition: all 0.2s ease;
  background: #6644a8;
  right: 0%;
}
.add-btn:hover {
  background: #05e0e9;
}
.cancel-btn{
  height: 55px;
  width: 50%;
  right: 0%;
  color: #fff;
  font-size: 1rem;
  font-weight: 400;
  border: none;
  border-radius: 25px;
  cursor: pointer;
  transition: all 0.2s ease;
  background: #e2e4e9;
}
.cancel-btn:hover {
  background: #817e9d;
}
/*Responsive*/
@media screen and (max-width: 500px) {
  .form .column {
    flex-wrap: wrap;
  }
  .form .buttons {
    flex-wrap: wrap;
  }
  .form :where(.device-option, .device) {
    row-gap: 15px;
  }
}

</style>

<!-- Hi Ruth -->

  </head>
  <body>
    <section class="container">
      <div class="title">Add Devices</div>
      <form method="POST" enctype="multipart/form-data" action="{{ url('addDevices') }}" class="form">
        @csrf
        <div class="input-box">
          <label>Device ID</label>
          <input type="text" placeholder="ITRO-DEV-ID" required maxlength="15" style="text-transform:uppercase"/> 
        </div>

        <div class="input-box">
          <label>Device Name</label>
          <input type="text" placeholder="Enter Device Name" name = "dname" required />
        </div>

        <div class="column">
          <div class="input-box">
            <label>Inventory Number</label>
            <input type="number" placeholder="Enter Inventory number" name= "dinvnum" required maxlength="4"/>
          </div>
          <div class="input-box">
            <label>Purchase Date</label>
            <input type="date" placeholder="Enter purchase date" name = "dpurchased" required />
          </div>
        </div>
        <div class="device-type">
          <label>Device Type</label>
          <div class="device-option">
            <div class="device">
              <input type="radio" id="check-computing" name="device" checked value = "COMPUTING"/>
              <label for="check-computing">Computing</label>
            </div>
            <div class="device">
              <input type="radio" id="check-networking" name="device" value = "NETWORKING"/>
              <label for="check-networking">Networking</label>
            </div>
            <div class="device">
              <input type="radio" id="check-av" name="device" value = "AV"/>
              <label for="check-av">Audio/Visual</label>
            </div>
            <div class="device">
              <input type="radio" id="check-utilities" name="device" value = "UTILITY"/>
              <label for="check-utilities">Utility</label>
            </div>
          </div>
        </div>
        <div class="input-box designation">
          <label>Device Assignment</label>
          <div class="column">
            <div class="select-box">
              <select name = "dfloor" >
                <option hidden>Floor</option>
                <option value= "10">1st floor</option>
                <option value= "20">2nd floor</option>
                <option value= "30">3rd floor</option>
                <option value= "40">4th floor</option>
                <option value= "50">5th floor</option>
                <option value= "60">6th floor</option>
                <option value= "70">7th floor</option>
                <option value= "80">8th floor</option>
                <option value= "90">9th floor</option>
                <option value= "100">10th floor</option>
                <option value= "110">11th floor</option>
                <option value= "120">12th floor</option>
              </select>
            </div>
            <input type="number" placeholder="Room Number" name="droom" required />
          </div>
        </div>
          <div class="buttons">
            <button class="button cancel-btn">Cancel</button>
            <button class="button add-btn">Submit</button>
        </div>
      </form>
    </section>