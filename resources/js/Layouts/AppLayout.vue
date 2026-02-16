<template>
    <div class="dashboard-container">
        <!-- Overlay for mobile -->
        <div v-if="isSidebarOpen" class="sidebar-overlay" @click="isSidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside class="sidebar shadow-sm" :class="{ 'show': isSidebarOpen }">
            <div class="sidebar-content">
                <div class="d-flex justify-content-end">
                    <button @click="isSidebarOpen = false" class="btn-close d-lg-none p-3" aria-label="Close"></button>
                </div>
                <!-- Logo/Header -->
                <div class="sidebar-header">
                    <div class="logo-icon">
                        <img src="/Images/scst.png" class="w-100" alt="">
                    </div>

                </div>

                <!-- Navigation Items -->
                <nav class="sidebar-nav">
                    <div>
                        <div class="side-bar-header">
                            <p class="text-dark text-uppercase">overview</p>
                        </div>
                        <div class="nav-item text-black px-2 mb-3">
                            <Link :href="route('home')" class="nav-link p-2" v-bind:class="{
                                active: addActiveClass(['home']),
                            }">
                            <i class="fa-solid fa-store"></i>
                            Home
                            </Link>
                        </div>
                        <div class="nav-item text-black px-2 mb-3">
                            <Link href="" class="nav-link p-2">
                            <i class="fa-solid fa-tags"></i>
                            Sales Orders
                            </Link>
                        </div>
                        <div class="nav-item text-black px-2 mb-3">
                            <Link :href="route('customers.index')" class="nav-link p-2" v-bind:class="{
                                active: addActiveClass(['customers.index']),
                            }">
                            <i class="fa-solid fa-users"></i>
                            Customers
                            </Link>
                        </div>
                        <div class="nav-item text-black px-2 mb-3">
                            <Link :href="route('products.index')" class="nav-link p-2" v-bind:class="{
                                active: addActiveClass(['products.index', 'products.create']),
                            }">
                            <i class="fa-brands fa-product-hunt"></i>
                            Products
                            </Link>
                        </div>
                    </div>
                </nav>

                <!-- User Profile Section -->
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="main-wrapper">
            <!-- Top Navigation Bar -->
            <header class="top-navbar shadow-sm mx-3 mt-3 rounded-4">
                <div class="d-flex align-items-center justify-content-between">
                    <button @click="isSidebarOpen = true" class="btn btn-link d-lg-none p-0">
                        <i class="fa-solid fa-bars fs-3 text-dark"></i>
                    </button>
                    <div class="d-none d-lg-block">

                    </div>
                    <div class="d-flex align-items-center profile">
                        <!-- <button class="btn btn-link position-relative p-2">
              <i class="bi bi-bell fs-5 text-secondary"></i>
              <span class="notification-badge"></span>
            </button> -->
                        <div class="dropdown">
                            <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                                style="cursor: pointer;">
                                <img :src="$page.props.auth.user.profile_photo_url" alt="Profile" class="rounded-circle"
                                    style="width: 40px; height: 40px; object-fit: cover;">
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end mt-3 border-0 p-2 shadow rounded-4">
                                <li class="dropdown-header">
                                    <div class="d-flex align-items-center">
                                        <img :src="$page.props.auth.user.profile_photo_url" alt="Profile"
                                            class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                        <div>
                                            <div class="fw-bold text-black">{{ $page.props.auth.user.name }}</div>
                                            <small class="text-muted">{{ $page.props.auth.user.email }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <Link class="dropdown-item text-danger" @click="logout()">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="main-content py-3 px-1 mx-3 mt-3 shadow-sm bg-white">
                <div class="container-fluid p-4">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    data() {
        return {
            isSidebarOpen: false,
            currentRoute: "",
        };
    },
    components: {
        Link,
    },
    methods: {
        logout() {
            this.$inertia.post(this.route('logout'));
        },
        addActiveClass(routes) {
            if (routes.includes(route().current())) {
                return true;
            } else {
                return false;
            }
        },
    },

}
</script>

<style></style>
