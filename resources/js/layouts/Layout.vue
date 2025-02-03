<template>
  <div class="d-flex flex-column flex-md-row">
    <!-- Sidebar -->
    <div id="sidebar" class="bg-white text-white p-3" style="width: 250px; min-height: 100vh;">
      <h4 class="mb-0 text-center"><img src="https://www.lensasoftware.com/wp-content/uploads/2017/08/Lensa-logo.png" style="width: 100px;" alt=""></h4>
      <ul class="nav flex-column mt-5">
        <li class="nav-item mb-3">
          <router-link to="/" class="nav-link text-dark px-3 fw-bold" active-class="active">Employees</router-link>
        </li>
        <li class="nav-item mb-3">
          <router-link to="/annual-salary" class="nav-link text-dark px-3 fw-bold" active-class="active">Annual Salary</router-link>
        </li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 bg-white">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Lensa Software</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto d-sm-none">
              <!-- Menu mobile -->
              <li class="nav-item">
                <router-link to="/" class="nav-link text-dark px-3" active-class="active">Employees</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/annual-salary" class="nav-link text-dark px-3" active-class="active">Annual Salary</router-link>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- Dynamic Content -->
      <div class="container-fluid ps-0" style="background: rgb(241, 245, 249); border-top-left-radius: 16px; height: 100vh;">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Layout',
};
</script>

<style scoped>
  #sidebar {
    transition: all 0.3s ease;
  }

  @media (max-width: 768px) {
    #sidebar {
      display: none;
    }

    .d-flex {
      flex-direction: column;
    }

    .navbar-toggler {
      display: block;
    }
  }
  .nav-item a{
    font-size: 12px;
  }
  .nav-item .active{
    background: #2f3191;
    color: #fff !important;
    border-radius: 15px;
  }
</style>
