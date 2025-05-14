<?php
// resources/views/components/sidebar.php
?>
<aside class="sidebar position-fixed h-100 bg-light border-end" style="width:300px;">
    <div class="sidebar-header p-3">
        <h5>Company Admin</h5>
    </div>
    <nav class="sidebar-nav">
        <ul class="list-unstyled">
            <li>
                <a href="/admin/dashboard" class="d-block p-2">Dashboard</a>
            </li>
            <li>
                <a href="#functionsMenu" data-bs-toggle="collapse" aria-expanded="false" class="d-block p-2 dropdown-toggle">
                    Functions
                </a>
                <ul class="collapse list-unstyled ps-3" id="functionsMenu">
                    <!-- Placeholder for suits -->
            
                    <li>
                        <a href="#suit1Submenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            Suit 1
                        </a>
                        <ul class="collapse list-unstyled ps-3" id="suit1Submenu">
                            <!-- Placeholder for functions under Suit 1 -->
                        </ul>
                    </li>
                
                </ul>
            </li>
            <li>
                <a href="/admin/users" class="d-block p-2">Users</a>
            </li>
            <li>
                <a href="/admin/companies" class="d-block p-2">Companies</a>
            </li>
            <!-- Additional static links -->
        </ul>
    </nav>
</aside>
