<title>Create KB | RAMS Corner</title>
<link rel="stylesheet" href="{{ asset('assets/css/add_kb.css') }}" type = "text/css">
</head>

<body>
    <section class="container">
        <div class="title">Add New KB Entry</div>
        <form method = "post" action="{{ url('/createKB') }}" class="form">
            @csrf
            <div class="article">
                <label for="title">KB Article Title</label>
                <input type="text" id="title" name="title" placeholder="Enter Article Title" maxlength="20"
                    required />
            </div>
            <div class="categories">
                <span>Category</span>
                <div class="options">
                    <div class="type">
                        <input type="radio" id="c-software" name="category" value="SOFTWARE" checked> <span
                            style="color:#707070; margin-bottom: 5px;">Software</span>
                    </div>
                    <div class="type">
                        <input type="radio" id="c-hardware" name="category" value="INFRASTRUCTURE" /> <span
                            style="color:#707070;">Infrastructure</span>
                    </div>
                </div>
            </div>

            <div class="content">
                <label for="content">Content</label>
                <textarea id="content" name="content" placeholder="Enter Content"
                    style="resize:vertical; margin-bottom: 1rem; width:100%; border-radius:25px; padding:.5rem; font-size:1rem; color: #817e9d; border: 1px solid  #ddd; height: 12vh; margin-top: 10px;""></textarea>
            </div>

            <div class="resolution">
                <label for="resolution">Resolution</label>
                <textarea id="resolution1" name="resolution" placeholder="Enter Resolution"
                    style="resize:vertical; margin-bottom: 1rem; width:100%; border-radius:25px; padding:.5rem; font-size:1rem; color: #817e9d; border: 1px solid  #ddd; height: 18vh; margin-top: 10px;""></textarea>
            </div>

            <!-- <div class="categories">
          <span>Available for Client View?</span>
          <div class="options">
            <div class="type">
              <input type="radio" name="types" value="No" checked> <span style="color:#707070; margin-bottom: 5px; margin-right: 35px;">Yes</span>
            </div>
            <div class="type">
              <input type="radio" name="types" value="No" /> <span style="color:#707070;">No</span>
            </div>
          </div>
        </div> -->
            <div class="article">
                <!-- <label for="title" style="font-weight: bolder; color: #817e9d; margin-right: 2rem;">Client Visibility: </label> -->
                <label for="title" style="margin-right: 2rem;">Client Visibility</label>
                <label class="switch">
                    <input type="checkbox" value="1" name="userview">
                    <span class="slider round"></span>
                </label>
            </div>


            <div class="buttons">
                <button class="button cancel-btn" type="reset">Cancel</button>
                <button class="button add-btn" type="submit">Submit</button>
        </form>
    </section>

    @include('footer')
