package rockpaperscissors;

import entities.Enemies;
import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.Font;
import java.awt.FontFormatException;
import java.awt.GraphicsEnvironment;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.io.File;
import java.io.IOException;
import java.util.Timer;
import java.util.TimerTask;
import java.util.concurrent.TimeUnit;
import java.util.logging.Level;
import java.util.logging.Logger;

import javax.swing.Icon;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.SwingConstants;
import javax.swing.border.Border;
import javax.swing.border.LineBorder;

public class MyFrame extends JFrame implements ActionListener {
    
    public int screenHeight = 1000, screenWidth = 1280;
    JButton rock, paper, scissors, start, exit, menu;
    int buttonLength = 200, buttonHeight = 75;
    int playerLives = 3;
    MusicPlayer mPlayer = new MusicPlayer();

    //Load Icons
    public Icon background1 = new ImageIcon("src/res/backgrounds/background1.png");
    public Icon background2 = new ImageIcon("src/res/backgrounds/background2.png");
    public Icon background3 = new ImageIcon("src/res/backgrounds/background3.png");
    public Icon titleScreen = new ImageIcon("src/res/backgrounds/titleScreen.png");
    public Icon rockIcon = new ImageIcon("src/res/buttons/rock.png");
    public Icon rockDisabledIcon = new ImageIcon("src/res/buttons/rockD.png");
    public Icon paperIcon = new ImageIcon("src/res/buttons/paper.png");
    public Icon paperDisabledIcon = new ImageIcon("src/res/buttons/paperD.png");
    public Icon scissorsIcon = new ImageIcon("src/res/buttons/scissors.png");
    public Icon scissorsDisabledIcon = new ImageIcon("src/res/buttons/scissorsD.png");
    public Icon startIcon = new ImageIcon("src/res/buttons/start.png");
    public Icon exitIcon = new ImageIcon("src/res/buttons/exit.png");
    public Icon dialogueIcon = new ImageIcon("src/res/dialogue/dialogueBox.png");
    public Icon balloonPRockIcon = new ImageIcon("src/res/content/balloonPlayerRock.png");
    public Icon balloonPPaperIcon = new ImageIcon("src/res/content/balloonPlayerPaper.png");
    public Icon balloonPScissorsIcon = new ImageIcon("src/res/content/balloonPlayerScissors.png");
    public Icon balloonERockIcon = new ImageIcon("src/res/content/balloonEnemyRock.png");
    public Icon balloonEPaperIcon = new ImageIcon("src/res/content/balloonEnemyPaper.png");
    public Icon balloonEScissorsIcon = new ImageIcon("src/res/content/balloonEnemyScissors.png");
    public Icon playerIcon = new ImageIcon("src/res/sprites/playerSprite.png");
    public Icon menuIcon = new ImageIcon("src/res/content/menuBackground.png");
    public Icon playerDamagedIcon = new ImageIcon("src/res/sprites/playerSpriteDamaged.png");
    public Icon backgroundFight = new ImageIcon("src/res/backgrounds/backgroundFight.png");
    public Icon skipIcon = new ImageIcon("src/res/buttons/skipBtn.png");
    public Icon gameOverScreen = new ImageIcon("src/res/backgrounds/gameOver.png");
    public Icon confirmSkipIcon = new ImageIcon("src/res/buttons/confirmSkip.png");
    public Icon cancelSkipIcon = new ImageIcon("src/res/buttons/cancelSkip.png");

    //Instantiate Label for background
    JLabel backgroundLbl = new JLabel();
    JLabel enemyLbl = new JLabel();
    JLabel dialogueLbl = new JLabel(dialogueIcon);
    JLabel portraitLbl = new JLabel();
    JLabel rpsTimerLbl = new JLabel();
    JLabel playerHpLbl = new JLabel();
    JLabel enemyHpLbl = new JLabel();
    JLabel balloonPLbl = new JLabel();
    JLabel balloonELbl = new JLabel();
    JLabel skipConfirm = new JLabel();
    JLabel playerLbl = new JLabel(playerIcon);
    Border noBorder = new LineBorder(Color.WHITE, 0);
    JLabel menuBackgroundLbl = new JLabel(menuIcon);
    JLabel dialogueTextLbl = new JLabel();
    JButton skipBtn = new JButton();
    JButton confirmSkip = new JButton();
    JButton cancelSkip = new JButton();
    //Import enemy and cutscene classes
    Enemies en;
    Cutscene cs;

    //sound paths
    public String bonk = "src/res/sounds/bonk.wav";
    public String select = "src/res/sounds/select.wav";
    //declare variables
    
    int enemyID = 0;
    int timesClicked = 0;
    long lastTime;
    long currentTime;
    int rpsTimer = 3;
    boolean rockSelected = false;
    boolean paperSelected = false;
    boolean scissorsSelected = false;
    int year = 0;
    int wins = 0;
    boolean afterMatch = false;
    int enemyX = screenWidth - 480;
    int playerX = 110;
    int entityY = screenHeight - 975;
    int entitySize = 480;
    int turnNumber = 0;
    int csID = 0;
    boolean isCutscene = false;
    
    MyFrame() {
        getNewFont();
        rpsTimerLbl.setFont(new Font("Pixels", Font.PLAIN, 200));
        dialogueTextLbl.setFont(new Font("Pixels", Font.PLAIN, 70));
        skipConfirm.setFont(new Font("Pixels", Font.PLAIN, 60));
        skipConfirm.setForeground(Color.WHITE);
        this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        this.setLayout(null);
        this.setResizable(false);
        this.setSize(screenWidth, screenHeight);
        this.setTitle("Osvaldo's Legacy");
        this.setLocationRelativeTo(null);
        this.setLayout(new BorderLayout());
        this.setContentPane(backgroundLbl);
        skipBtn.setBounds(screenWidth - 250, screenHeight - 120, 40, 35);
        skipBtn.setIcon(skipIcon);
        skipBtn.setBorder(noBorder);
        skipBtn.addActionListener(this);
        skipBtn.setVisible(false);
        this.add(skipBtn);
        confirmSkip = new JButton();
        cancelSkip = new JButton();
        confirmSkip.setBounds(screenWidth/2-50, screenHeight/2, 40, 35);
        cancelSkip.setBounds(screenWidth/2+25, screenHeight/2, 40, 35);
        confirmSkip.setIcon(confirmSkipIcon);
        cancelSkip.setIcon(cancelSkipIcon);
        confirmSkip.setBorder(noBorder);
        cancelSkip.setBorder(noBorder);
        confirmSkip.addActionListener(this);
        cancelSkip.addActionListener(this);
        confirmSkip.setVisible(false);
        cancelSkip.setVisible(false);
        this.add(confirmSkip);
        this.add(cancelSkip);
        start = new JButton();
        exit = new JButton();
        menu = new JButton();
        menu.setBorder(noBorder);
        start.setBorder(noBorder);
        exit.setBorder(noBorder);
        menu.setBounds((int) (screenWidth / 2) - buttonLength / 2, screenHeight / 2 - buttonHeight / 2, buttonLength, buttonHeight);
        start.setBounds((int) (screenWidth / 2) - buttonLength / 2, screenHeight / 2 - buttonHeight / 2, buttonLength, buttonHeight);
        exit.setBounds((int) (screenWidth / 2) - buttonLength / 2, screenHeight / 2 + (int) 1.5 * buttonHeight, buttonLength, buttonHeight);
        menu.setIcon(startIcon);
        start.setIcon(startIcon);
        exit.setIcon(exitIcon);
        this.add(menu);
        menu.addActionListener(this);
        this.add(start);
        start.addActionListener(this);
        this.add(exit);
        exit.addActionListener(this);
        
        this.setLayout(null);
        skipConfirm.setOpaque(true);
        skipConfirm.setVerticalAlignment(SwingConstants.TOP);
        skipConfirm.setHorizontalAlignment(SwingConstants.CENTER);
        skipConfirm.setBounds(screenWidth / 3 + screenWidth / 20, screenHeight / 3, screenWidth / 4, screenHeight / 4);
        skipConfirm.setBackground(Color.black);
        skipConfirm.setText("<html>Skip the cutscene?</html>");
        this.add(skipConfirm);
        skipConfirm.setVisible(false);
        dialogueTextLbl.setOpaque(false);
        dialogueTextLbl.setVerticalAlignment(SwingConstants.TOP);
        dialogueTextLbl.setVisible(false);
        dialogueLbl.setBounds(0, screenHeight - 340, 1280, 304);
        dialogueLbl.setHorizontalTextPosition((int) dialogueLbl.CENTER);
        dialogueLbl.setVerticalTextPosition(dialogueLbl.CENTER);
        portraitLbl.setBounds(screenWidth - 320, screenHeight - 340, 320, 304);
        this.add(portraitLbl);
        this.add(dialogueTextLbl);
        
        portraitLbl.setVisible(false);
        this.add(dialogueLbl);
        dialogueLbl.addMouseListener(new MouseAdapter() {
            @Override
            public void mouseClicked(MouseEvent e) {
                timesClicked++;
                if (isCutscene == true) {
                    if (timesClicked < cs.maxDialogue) {
                        dialogueTextLbl.setText(cs.cutscene[timesClicked]);
                    } else {
                         skipBtn.setVisible(false);
                        timesClicked = 0;
                        if(csID==1){
                            System.exit(0);
                        }
                        else{
                        dialogue();}
                    }                    
                    if (timesClicked == cs.csTrigger[0] && cs.maxTrigger>=1) {
                        backgroundLbl.setIcon(cs.cutsceneIcon[1]);
                    }
                    if (timesClicked == cs.csTrigger[1] && cs.maxTrigger>=2) {
                        backgroundLbl.setIcon(cs.cutsceneIcon[2]);
                    }
                    if (timesClicked == cs.csTrigger[2] && cs.maxTrigger>=3) {
                        backgroundLbl.setIcon(cs.cutsceneIcon[3]);
                    }
                } else {
                    if (afterMatch == true) {
                        if (timesClicked < en.maxDialogueAfter) {
                            dialogueTextLbl.setText(en.dialogueAfter[timesClicked]);
                        } else {
                            timesClicked = 0;
                            afterMatch = false;
                          
                            if(enemyID!=3){
                            enemyID++;
                            dialogue();}
                            else{         
                            dialogueLbl.setVisible(false);
                            dialogueTextLbl.setVisible(false);
                            portraitLbl.setVisible(false);
                            csID=1;
                            cutscene();
                            }
                        }
                    } else {
                        if (timesClicked < en.maxDialogueBefore) {
                            dialogueTextLbl.setText(en.dialogueBefore[timesClicked]);
                        } else {
                            timesClicked = 0;
                            dialogueLbl.setVisible(false);
                            dialogueTextLbl.setVisible(false);
                            portraitLbl.setVisible(false);
                            rpsMenu();
                        }
                    }
                }
            }
        });
        dialogueLbl.setVisible(false);
        this.setLayout(new BorderLayout());
        rock = new JButton();
        rock.setBorder(noBorder);
        paper = new JButton();
        paper.setBorder(noBorder);
        scissors = new JButton();
        scissors.setBorder(noBorder);
        rock.setBounds((int) (screenWidth / 2) - 2 * buttonLength, 750, buttonLength, buttonHeight);
        paper.setBounds((int) (screenWidth / 2) - buttonLength / 2, 750, buttonLength, buttonHeight);
        scissors.setBounds((int) (screenWidth / 2) + buttonLength, 750, buttonLength, buttonHeight);
        rock.setIcon(rockIcon);
        rock.setDisabledIcon(rockDisabledIcon);
        rock.setRolloverIcon(rockDisabledIcon);
        paper.setIcon(paperIcon);
        paper.setDisabledIcon(paperDisabledIcon);
        paper.setRolloverIcon(paperDisabledIcon);
        scissors.setIcon(scissorsIcon);
        scissors.setDisabledIcon(scissorsDisabledIcon);
        scissors.setRolloverIcon(scissorsDisabledIcon);
        rock.addActionListener(this);
        paper.addActionListener(this);
        scissors.addActionListener(this);
        this.add(rock);
        rock.setVisible(false);
        this.add(paper);
        paper.setVisible(false);
        this.add(scissors);
        scissors.setVisible(false);
        this.setLayout(null);
        playerHpLbl.setBounds(0, screenHeight - 325, 87, 288);
        enemyHpLbl.setBounds(screenWidth - 100, screenHeight - 325, 87, 288);
        enemyLbl.setBounds(enemyX, entityY, entitySize, entitySize);
        playerLbl.setBounds(playerX, entityY, entitySize, entitySize);
        playerHpLbl.setIcon(new ImageIcon("src/res/content/hpBar" + playerLives + ".png"));
        this.add(playerHpLbl);
        playerHpLbl.setVisible(false);
        this.add(enemyHpLbl);
        enemyHpLbl.setVisible(false);
        this.add(enemyLbl);
        enemyLbl.setVisible(false);
        this.add(playerLbl);
        playerLbl.setVisible(false);
        rpsTimerLbl.setBounds(screenWidth / 2 - 20, 0, 200, 200);
        rpsTimerLbl.setForeground(Color.WHITE);
        rpsTimerLbl.setText(Integer.toString(rpsTimer));
        this.add(rpsTimerLbl);
        rpsTimerLbl.setVisible(false);
        menuBackgroundLbl.setBounds(0, screenHeight - 340, 1280, 307);
        this.add(menuBackgroundLbl);
        menuBackgroundLbl.setVisible(false);
        balloonPLbl.setBounds(450, 100, 320, 145);
        balloonELbl.setBounds(450, 300, 320, 145);
        this.add(balloonPLbl);
        this.add(balloonELbl);
        balloonPLbl.setVisible(false);
        menu.setVisible(false);
        mainMenu();
    }
    
    public void mainMenu() {
        //Menu Setup
        backgroundLbl.setIcon(titleScreen);
        mPlayer.playMusic("src/res/music/bgm0.wav");
        start.setVisible(true);
        exit.setVisible(true);
        this.setVisible(true);
    }
    
    public void cutscene() {
        //Implement skip button
        skipBtn.setVisible(true);
        dialogueTextLbl.setForeground(Color.white);
        dialogueTextLbl.setBounds(190, screenHeight - 300, 950, 304);
        //Cutscene Setup
        isCutscene = true;
        cs = new Cutscene(csID);
        mPlayer.stopMusic();
        mPlayer.playMusic(cs.csSongs[0]);
        backgroundLbl.setIcon(cs.cutsceneIcon[0]);
        dialogueLbl.setVisible(true);
        dialogueTextLbl.setVisible(true);
        this.setLayout(new BorderLayout());
        this.setContentPane(backgroundLbl);
        
        dialogueTextLbl.setText(cs.cutscene[timesClicked]);
    }
    
    public void dialogue() {
        dialogueTextLbl.setBounds(190, screenHeight - 300, 700, 304);
        //Dialogue Setup
        isCutscene = false;
        mPlayer.stopMusic();
        //add dialogue music
        en = new Enemies(enemyID);
        dialogueTextLbl.setForeground(en.enemyColor);
        portraitLbl.setIcon(en.portraitIcon);
        dialogueLbl.setVisible(true);
        dialogueTextLbl.setVisible(true);
        portraitLbl.setVisible(true);
        enemyLbl.setIcon(en.enemyIcon);
        this.setLayout(new BorderLayout());
        backgroundLbl.setIcon(en.enemyCg);
        this.setContentPane(backgroundLbl);

        //Dialogue Box
        if (afterMatch == true) {
            dialogueTextLbl.setText(en.dialogueAfter[timesClicked]);
        } else {
            dialogueTextLbl.setText(en.dialogueBefore[timesClicked]);
        }
    }
    
    public void rpsMenu() {
        //RPS Setup
        mPlayer.stopMusic();
        mPlayer.playMusic("src/res/music/bgm1.wav");
        playerLives = 3;
        playerHpLbl.setIcon(new ImageIcon("src/res/content/hpBar" + playerLives + ".png"));
        enemyHpLbl.setIcon(new ImageIcon("src/res/content/hpBar" + en.maxLives + ".png"));
        rpsTimer = 3;
        this.setLayout(new BorderLayout());
        backgroundLbl.setIcon(backgroundFight);
        this.setContentPane(backgroundLbl);
        this.setLayout(null);
        rock.setEnabled(true);
        paper.setEnabled(true);
        scissors.setEnabled(true);
        rock.setVisible(true);
        paper.setVisible(true);
        scissors.setVisible(true);
        menuBackgroundLbl.setVisible(true);
        enemyLbl.setVisible(true);
        playerLbl.setVisible(true);
        enemyHpLbl.setVisible(true);
        playerHpLbl.setVisible(true);
        rpsTimerLbl.setVisible(true);
        //Actual Match
        matchLogic();
        
    }
    
    public void matchLogic() {
        
        Timer timer = new Timer();
        timer.schedule(new TimerTask() {
            @Override
            //Game Loop
            public void run() {
                if (rpsTimerLbl.isVisible() == false) {
                    rpsTimerLbl.setVisible(true);
                }
                //Alien Cheat
                if (rpsTimer == 1 && enemyID == 3) {
                        enemyLbl.setIcon(en.enemyActivated);
                        en.cheat(rockSelected, paperSelected, scissorsSelected);
                }
                
                if (rpsTimer == 0) {
                    rpsTimerLbl.setVisible(false);
                    rock.setEnabled(false);
                    paper.setEnabled(false);
                    scissors.setEnabled(false);
                    rpsTimerLbl.setText(Integer.toString(rpsTimer));
                    if (enemyID == 3) {
                        enemyLbl.setIcon(en.enemyIcon);
                    }
                    if (enemyID != 3) {
                        en.chooseOption();
                    }
                    
                    if (en.choice == "Rock") {
                        balloonELbl.setVisible(true);
                        balloonELbl.setIcon(balloonERockIcon);
                    } else if (en.choice == "Paper") {
                        balloonELbl.setVisible(true);
                        balloonELbl.setIcon(balloonEPaperIcon);
                    } else if (en.choice == "Scissors") {
                        balloonELbl.setVisible(true);
                        balloonELbl.setIcon(balloonEScissorsIcon);
                    }
                    if (rockSelected == true) {
                        balloonPLbl.setVisible(true);
                        balloonPLbl.setIcon(balloonPRockIcon);
                        if (en.choice == "Scissors") {
                            mPlayer.playOnce(bonk);
                            enemyLbl.setBounds(enemyX - 10, entityY, entitySize, entitySize);
                            shleep(125);
                            enemyLbl.setBounds(enemyX + 10, entityY, entitySize, entitySize);
                            shleep(125);
                            enemyLbl.setBounds(enemyX, entityY, entitySize, entitySize);
                            en.maxLives--;
                        }
                        if (en.choice == "Paper") {
                            playerLbl.setIcon(playerDamagedIcon);
                            mPlayer.playOnce(bonk);
                            playerLbl.setBounds(playerX + 10, entityY, entitySize, entitySize);
                            shleep(125);
                            playerLbl.setBounds(playerX - 10, entityY, entitySize, entitySize);
                            shleep(125);
                            playerLbl.setBounds(playerX, entityY, entitySize, entitySize);
                            playerLbl.setIcon(playerIcon);
                            playerLives--;
                        }
                        if (en.choice == "Rock") {
                        }
                    } else if (paperSelected == true) {
                        balloonPLbl.setVisible(true);
                        balloonPLbl.setIcon(balloonPPaperIcon);
                        if (en.choice == "Scissors") {
                            playerLbl.setIcon(playerDamagedIcon);
                            mPlayer.playOnce(bonk);
                            playerLbl.setBounds(playerX + 10, entityY, entitySize, entitySize);
                            shleep(125);
                            playerLbl.setBounds(playerX - 10, entityY, entitySize, entitySize);
                            shleep(125);
                            playerLbl.setBounds(playerX, entityY, entitySize, entitySize);
                            playerLbl.setIcon(playerIcon);
                            playerLives--;
                        }
                        if (en.choice == "Paper") {
                        }
                        if (en.choice == "Rock") {
                            mPlayer.playOnce(bonk);
                            enemyLbl.setBounds(enemyX - 10, entityY, entitySize, entitySize);
                            shleep(125);
                            enemyLbl.setBounds(enemyX + 10, entityY, entitySize, entitySize);
                            shleep(125);
                            enemyLbl.setBounds(enemyX, entityY, entitySize, entitySize);
                            en.maxLives--;
                        }
                    } else if (scissorsSelected == true) {
                        balloonPLbl.setVisible(true);
                        balloonPLbl.setIcon(balloonPScissorsIcon);
                        if (en.choice == "Scissors") {
                        }
                        if (en.choice == "Paper") {
                            mPlayer.playOnce(bonk);
                            enemyLbl.setBounds(enemyX - 10, entityY, entitySize, entitySize);
                            shleep(125);
                            enemyLbl.setBounds(enemyX + 10, entityY, entitySize, entitySize);
                            shleep(125);
                            enemyLbl.setBounds(enemyX, entityY, entitySize, entitySize);
                            en.maxLives--;
                        }
                        if (en.choice == "Rock") {
                            playerLbl.setIcon(playerDamagedIcon);
                            mPlayer.playOnce(bonk);
                            playerLbl.setBounds(playerX + 10, entityY, entitySize, entitySize);
                            shleep(125);
                            playerLbl.setBounds(playerX - 10, entityY, entitySize, entitySize);
                            shleep(125);
                            playerLbl.setBounds(playerX, entityY, entitySize, entitySize);
                            playerLbl.setIcon(playerIcon);
                            playerLives--;
                        }
                        
                    } else {
                        playerLbl.setIcon(playerDamagedIcon);
                        mPlayer.playOnce(bonk);
                        playerLives--;
                        playerLbl.setBounds(playerX + 10, entityY, entitySize, entitySize);
                        shleep(125);
                        playerLbl.setBounds(playerX - 10, entityY, entitySize, entitySize);
                        shleep(125);
                        playerLbl.setBounds(playerX, entityY, entitySize, entitySize);
                        playerLbl.setIcon(playerIcon);
                    }
                    shleep(2000);
                    balloonPLbl.setVisible(false);
                    balloonELbl.setVisible(false);
                    playerHpLbl.setIcon(new ImageIcon("src/res/content/hpBar" + playerLives + ".png"));
                    enemyHpLbl.setIcon(new ImageIcon("src/res/content/hpBar" + en.maxLives + ".png"));
                    rock.setEnabled(true);
                    rockSelected = false;
                    paper.setEnabled(true);
                    paperSelected = false;
                    scissors.setEnabled(true);
                    scissorsSelected = false;
                    turnNumber++;
                    
                    if (playerLives > 0 && en.maxLives > 0) {
                        timer.cancel();
                        rpsTimer = 3;
                        matchLogic();
                    } else if (playerLives > 0) {
                        System.out.println("YOU WIN");
                        timer.cancel();
                        balloonPLbl.setVisible(false);
                        balloonELbl.setVisible(false);
                        rock.setVisible(false);
                        paper.setVisible(false);
                        scissors.setVisible(false);
                        playerHpLbl.setVisible(false);
                        enemyHpLbl.setVisible(false);
                        menuBackgroundLbl.setVisible(false);
                        enemyLbl.setVisible(false);
                        playerLbl.setVisible(false);
                        rpsTimerLbl.setVisible(false);
                        wins++;
                        afterMatch = true;
                        turnNumber = 0;
                        dialogue();
                    } else if (en.maxLives > 0) {
                        System.out.println("YOU LOSE");
                        timer.cancel();
                        balloonPLbl.setVisible(false);
                        balloonELbl.setVisible(false);
                        rock.setVisible(false);
                        paper.setVisible(false);
                        scissors.setVisible(false);
                        playerHpLbl.setVisible(false);
                        enemyHpLbl.setVisible(false);
                        menuBackgroundLbl.setVisible(false);
                        enemyLbl.setVisible(false);
                        playerLbl.setVisible(false);
                        rpsTimerLbl.setVisible(false);
                        turnNumber = 0;
                        gameOver();
                    }
                } else {
                    
                    rpsTimerLbl.setText(Integer.toString(rpsTimer));
                    rpsTimer--;
                }
                
            }
        }, 0, 1000);
    }
    
    public void gameOver() {
        mPlayer.stopMusic();
        backgroundLbl.setIcon(gameOverScreen);
        menu.setVisible(true);
        exit.setVisible(true);
    }
    
    public void ending(){
       
    }
    
    public void shleep(int n) {
        //Makes delays
        try {
            TimeUnit.MILLISECONDS.sleep(n);
        } catch (InterruptedException ex) {
            Logger.getLogger(MyFrame.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    public void getNewFont() {
        //gets Pixel font
        try {
            GraphicsEnvironment ge
                    = GraphicsEnvironment.getLocalGraphicsEnvironment();
            ge.registerFont(Font.createFont(Font.TRUETYPE_FONT, new File("src/res/content/Pixels.ttf")));
        } catch (IOException | FontFormatException e) {
            //Handle exception
        }
    }
    
    @Override
    //Mouse Clicks
    public void actionPerformed(ActionEvent e) {
        if (e.getSource() == rock) {
            mPlayer.playOnce(select);
            rock.setEnabled(false);
            rockSelected = true;
            if (paper.isEnabled() == false) {
                paper.setEnabled(true);
                paperSelected = false;
            }
            if (scissors.isEnabled() == false) {
                scissors.setEnabled(true);
                scissorsSelected = false;
            }
        }
        if (e.getSource() == paper) {
            mPlayer.playOnce(select);
            paper.setEnabled(false);
            paperSelected = true;
            if (rock.isEnabled() == false) {
                rock.setEnabled(true);
                rockSelected = false;
            }
            if (scissors.isEnabled() == false) {
                scissors.setEnabled(true);
                scissorsSelected = false;
            }
        }
        if (e.getSource() == scissors) {
            mPlayer.playOnce(select);
            scissors.setEnabled(false);
            scissorsSelected = true;
            if (rock.isEnabled() == false) {
                rock.setEnabled(true);
                rockSelected = false;
            }
            if (paper.isEnabled() == false) {
                paper.setEnabled(true);
                paperSelected = false;
            }
        }
        if (e.getSource() == exit) {
            mPlayer.playOnce(select);
            System.exit(0);
        }
        if (e.getSource() == start) {
            mPlayer.playOnce(select);
            start.setVisible(false);
            exit.setVisible(false);
            cutscene();
            //dialogue();
            //gameOver();
        }
        if (e.getSource() == skipBtn) {
            mPlayer.playOnce(select);
            skipBtn.setEnabled(false);
            skipConfirm.setVisible(true);
            confirmSkip.setVisible(true);
            cancelSkip.setVisible(true);
          //  timesClicked = 0;
          //  skipBtn.setVisible(false);
         //   dialogue();
        }
        if(e.getSource()==confirmSkip){
            mPlayer.playOnce(select);
            timesClicked = 0;
            skipBtn.setEnabled(true);
            skipConfirm.setVisible(false);
            confirmSkip.setVisible(false);
            cancelSkip.setVisible(false);
            skipBtn.setVisible(false);
            if(csID==0)
            dialogue();
            if(csID==1)
            System.exit(0);
        }
        if(e.getSource()==cancelSkip){
            mPlayer.playOnce(select);
            skipBtn.setEnabled(true);
            skipConfirm.setVisible(false);
            confirmSkip.setVisible(false);
            cancelSkip.setVisible(false);
        }
        if (e.getSource() == menu) {
            menu.setVisible(false);
            exit.setVisible(false);
            dialogue();
        }
    }
}
