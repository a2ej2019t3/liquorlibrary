<?php
$statusName = $res['statusName'];
              switch ($res['statusID']) {
                case 0:
                  $badgeType = 'badge-secondary';
                  break;
                case 1:
                  $badgeType = 'badge-info';
                  $statusName = 'paid';
                  break;
                case 2:
                  $badgeType = 'badge-primary';
                  break;
                case 3:
                  $badgeType = 'badge-warning';
                  break;
                case 4:
                  $badgeType = 'badge-success';
                  break;
                case 5:
                  $badgeType = 'badge-dark';
                  break;
                case 6:
                  $badgeType = 'badge-info';
                  $statusName = 'paid';
                  break;
                case 7:
                  $badgeType = 'badge-warning';
                default:
                  # code...
                  break;
              }