 <div class="page-wrapper">
    <div class="container">
      <header class="main-header">
        <a href="#">
          <img src="../img/logo.png" width="153" height="42" alt="Логитип Дела в порядке">
        </a>

        <div class="main-header__side">
              <?php if (isset($_SESSION['user'])) :?>
            <a class="main-header__side-item button button--plus open-modal" href="pages/form-task.html">Добавить задачу</a>
            <div class="main-header__side-item user-menu">
                <div class="user-menu__image">
                    <img src="img/user.png" width="40" height="40" alt="Пользователь">
                </div>
                <div class="user-menu__data">
                    <p><?=$_SESSION['user']['name'];?></p>
                    <a href="/logout.php">Выйти</a>
                </div>
            <?php else: ?>
          <a class="main-header__side-item button button--transparent" href="/auth.php">Войти</a>
           <?php endif; ?>
        </div>
      </header>

      <div class="content">
        <section class="welcome">
          <h2 class="welcome__heading">«Дела в порядке»</h2>

          <div class="welcome__text">
            <p>«Дела в порядке» — это веб приложение для удобного ведения списка дел. Сервис помогает пользователям не забывать о предстоящих важных событиях и задачах.</p>

            <p>После создания аккаунта, пользователь может начать вносить свои дела, деля их по проектам и указывая сроки.</p>
          </div>

          <a class="welcome__button button" href="/register.php">Зарегистрироваться</a>
        </section>
      </div>
    </div>
  </div>
