  @include('header')
  <title>Add Devices | RAMS Corner</title>
  <link rel="stylesheet" href="{{ asset('assets/css/add-device.css') }}" type = "text/css">

  </head>

  <body>
      <section class="container">
          <div class="title">Add Devices</div>
          <form method="POST" enctype="multipart/form-data" action="{{ url('addDevices') }}" class="form">
              @csrf
              <div class="input-box">
                  <label>Device ID</label>
                  <input type="text" placeholder="ITRO-DEV-ID" required maxlength="15"
                      style="text-transform:uppercase" />
              </div>

              <div class="input-box">
                  <label>Device Name</label>
                  <input type="text" placeholder="Enter Device Name" name = "dname" required />
              </div>

              <div class="column">
                  <div class="input-box">
                      <label>Inventory Number</label>
                      <input type="number" placeholder="Enter Inventory number" name= "dinvnum" required
                          maxlength="4" />
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
                          <input type="radio" id="check-computing" name="device" checked value = "COMPUTING" />
                          <label for="check-computing">Computing</label>
                      </div>
                      <div class="device">
                          <input type="radio" id="check-networking" name="device" value = "NETWORKING" />
                          <label for="check-networking">Networking</label>
                      </div>
                      <div class="device">
                          <input type="radio" id="check-av" name="device" value = "AV" />
                          <label for="check-av">Audio/Visual</label>
                      </div>
                      <div class="device">
                          <input type="radio" id="check-utilities" name="device" value = "UTILITY" />
                          <label for="check-utilities">Utility</label>
                      </div>
                  </div>
              </div>
              <div class="input-box designation">
                  <label>Device Assignment</label>
                  <div class="column">
                      <div class="select-box">
                          <select name = "dfloor">
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
                  <button class="button cancel-btn" type = "reset">Cancel</button>
                  <button class="button add-btn" type = "submit">Submit</button>
              </div>
          </form>
      </section>
