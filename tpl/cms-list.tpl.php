<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatable" content="IE=edge">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>CMS List</title>
        <!--Jeremy Brannen-->
        <script>

        </script>
        <style>
            
        </style>
    </head>

    <body>

        <h1>CMS</h1>
        <a href="cms-edit.php"><button>Add A CMS Page</button></a>
        <table>
            <thead>
                <tr>
                    <th scope="col">CMS Name</th>
                    <!-- <th scope="col">cms Level</th> -->
                </tr>
            </thead>
            <?php  foreach($cmsList as $cmsData){ ?>
            <tbody>
                <tr>
                    <td><?= $cmsData['page_title'] ?></td>
                    <td></td>
                    <td><a href="cms-edit.php?cms_id=<?= $cmsData['cms_id'] ?>">Edit</a></td>
                    <td><a href="cms-view.php?cms_id=<?= $cmsData['cms_id'] ?>">View</a></td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
            <!-- insert php for widget here? -->
        <a href="index.php"><button>Return to Login Page</button></a>
    </body>

</html>