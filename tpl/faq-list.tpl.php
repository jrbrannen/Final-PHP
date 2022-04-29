<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatable" content="IE=edge">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>faq List</title>
        <!--Jeremy Brannen-->
        <script>

        </script>
        <style>
            
        </style>
    </head>

    <body>

        <h1>Faq</h1>
        <a href="faq-edit.php"><button>Add A Faq Question</button></a>
        <table>
            <thead>
                <tr>
                    <th scope="col">Faq Question List</th>
                    <!-- <th scope="col">faq Level</th> -->
                </tr>
            </thead>
            <?php  foreach($faqList as $faqData){ ?>
            <tbody>
                <tr>
                    <td><?= $faqData['faq_question'] ?></td>
                    <td></td>
                    <td><a href="faq-edit.php?faq_id=<?= $faqData['faq_id'] ?>">Edit</a></td>
                    <td><a href="faq-view.php?faq_id=<?= $faqData['faq_id'] ?>">View</a></td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
            <!-- insert php for widget here? -->
        <a href="index.php"><button>Return to Login Page</button></a>
    </body>

</html>