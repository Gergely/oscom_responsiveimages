<?php
// Example research file for coding
?>
<!DOCTYPE html>
<html lang=en> 
  <head> 
    <meta charset=utf-8>
    <meta content="IE=edge" http-equiv=X-UA-Compatible>
    <meta content="width=device-width,initial-scale=1" name=viewport>
    <meta content="Gergely Tóth" name=author>
    <title> Responsive Image Example </title> 
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel=stylesheet>
  <head>
  </head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <h2>Picture example <small>with pixels and img-responsive BS class</small></h2>
      <picture>
        <source media="(max-width: 640px)" srcset="<?= "resize.php?file=maxresdefault.png&size=640"; ?>">
        <source media="(max-width: 768px)" srcset="<?= "resize.php?file=maxresdefault.png&size=768";?>">
        <source media="(max-width: 1080px)" srcset="<?= "resize.php?file=maxresdefault.png&size=1080"; ?>">
        <source media="(max-width: 1280px)" srcset="<?= "resize.php?file=maxresdefault.png&size=1280"; ?>">
        <source media="(max-width: 1440px)" srcset="<?= "resize.php?file=maxresdefault.png&size=1440"; ?>">
        <img class="img-responsive" src="images/maxresdefault.png" alt="Full HD Example Picture">
      </picture>
    </div>
    <div class="col-md-6">
    <h2>HTML Source Code</h2>
      <pre>
        <code>
&lt;picture&gt;
  &lt;source media=&quot;(max-width: 640px)&quot; srcset=&quot;&lt;?= &quot;resize.php?file=maxresdefault.png&amp;size=640&quot;; ?&gt;&quot;&gt;
  &lt;source media=&quot;(max-width: 768px)&quot; srcset=&quot;&lt;?= &quot;resize.php?file=maxresdefault.png&amp;size=768&quot;;?&gt;&quot;&gt;
  &lt;source media=&quot;(max-width: 1080px)&quot; srcset=&quot;&lt;?= &quot;resize.php?file=maxresdefault.png&amp;size=1080&quot;; ?&gt;&quot;&gt;
  &lt;source media=&quot;(max-width: 1280px)&quot; srcset=&quot;&lt;?= &quot;resize.php?file=maxresdefault.png&amp;size=1280&quot;; ?&gt;&quot;&gt;
  &lt;source media=&quot;(max-width: 1440px)&quot; srcset=&quot;&lt;?= &quot;resize.php?file=maxresdefault.png&amp;size=1440&quot;; ?&gt;&quot;&gt;
  &lt;img class=&quot;img-responsive&quot; src=&quot;images/maxresdefault.png&quot; alt=&quot;Full HD Example Picture&quot;&gt;
&lt;/picture&gt;
        </code>
      </pre>
    </div>
    <div class="col-md-6">
      <h2>Media screen settings</h2>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Screen Width</th>
            <th>Cache Image Size</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><641px</td>
            <td>640px</td>
          </tr>
          <tr>
            <td><768px</td>
            <td>768px</td>
          </tr>
          <tr>
            <td>≥768px</td>
            <td>1080px</td>
          </tr>
          <tr>
            <td>≥1080px</td>
            <td>1280px</td>
          </tr>
          <tr>
            <td>≥1280px</td>
            <td>1440px</td>
          </tr>
          <tr>
            <td>≥1440px</td>
            <td>Full HD</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
</body>
</html>