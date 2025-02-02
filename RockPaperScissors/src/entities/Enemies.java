package entities;

import java.awt.Color;
import java.io.BufferedReader;
import java.io.DataInputStream;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.List;
import java.util.Random;
import javax.swing.Icon;
import javax.swing.ImageIcon;

public class Enemies {

    public String[] dialogueBefore = null;
    public int maxDialogueBefore = 0;
    public String[] dialogueAfter = null;
    public int maxDialogueAfter = 0;
    public Icon portraitIcon;
    public Icon enemyIcon;
    public Icon enemyCg;
    public Icon enemyActivated;
    public float maxRock;
    public float maxPaper;
    public float maxScissors;
    public int maxLives;
    public Color enemyColor;
    Random r = new Random();
    public String choice;
    float random;
    public int publicN = 0;
    List<String> lines = new ArrayList<String>();

    public Enemies(int n) {
        if (n == 0) {
            enemyColor = Color.WHITE;
            maxLives = 3;
            maxRock = (float) 0.0;
            maxPaper = (float) 0.0;
            maxScissors = (float) 1.0;
        } else if (n == 1) {
            enemyColor = Color.orange;
            maxLives = 3;
            maxRock = (float) 0.33;
            maxPaper = (float) 0.66;
            maxScissors = (float) 1.0;
        } else if (n == 2) {
            enemyColor = Color.RED;
            maxLives = 3;
            maxRock = (float) 0.22;
            maxPaper = (float) 0.66;
            maxScissors = (float) 1.0;
        } else if (n == 3) {
            enemyActivated = new ImageIcon("src/res/sprites/sprite3Active.png");
            enemyColor = Color.BLUE;
            maxLives = 3;
            maxRock = (float) 0.33;
            maxPaper = (float) 0.66;
            maxScissors = (float) 1.0;
        }
        enemyCg= new ImageIcon("src/res/backgrounds/cgEn"+n+".png");
        enemyIcon = new ImageIcon("src/res/sprites/sprite" + n + ".png");
        portraitIcon = new ImageIcon("src/res/dialogue/portrait" + n + ".png");
        publicN = n;
        loadDialogue(n);
    }

    public void chooseOption() {
        random = r.nextFloat();
        if (random <= maxRock) {
            choice = "Rock";
        } else if (random <= maxPaper && random > maxRock) {
            choice = "Paper";
        } else if (random <= maxScissors && random > maxPaper) {
            choice = "Scissors";
        }
    }

    public void cheat(boolean rock, boolean paper, boolean scissors) {
        if (rock == true) {
            choice = "Paper";
            if (maxLives == 2) {
                choice = "Rock";
            }
        } else if (paper == true) {
            choice = "Scissors";
            if (maxLives == 2) {
                choice = "Paper";
            }
        } else if (scissors == true) {
            choice = "Rock";
            if (maxLives == 2) {
                choice = "Scissors";
            }
        } else {
            chooseOption();
        }
    }

    public void loadDialogue(int n) {
        try {
            FileInputStream fstream_dialogue = new FileInputStream("src/res/dialogue/txts/Dialogue" + n + ".txt");
            DataInputStream data_input = new DataInputStream(fstream_dialogue);
            BufferedReader buffer = new BufferedReader(new InputStreamReader(data_input));
            String str_line;

            while ((str_line = buffer.readLine()) != null) {
                str_line = str_line.trim();
                if ((str_line.length() != 0)) {
                    lines.add(str_line);
                    maxDialogueBefore++;
                }
            }

            dialogueBefore = (String[]) lines.toArray(new String[lines.size()]);
            lines.clear();

            fstream_dialogue = (new FileInputStream("src/res/dialogue/txts/DialogueAfter" + n + ".txt"));
            data_input = new DataInputStream(fstream_dialogue);
            buffer = new BufferedReader(new InputStreamReader(data_input));

            while ((str_line = buffer.readLine()) != null) {
                str_line = str_line.trim();
                if ((str_line.length() != 0)) {
                    lines.add(str_line);
                    maxDialogueAfter++;
                }
            }
            dialogueAfter = (String[]) lines.toArray(new String[lines.size()]);
        } catch (Exception e) {
            // Catch exception if any
            System.err.println("Error: " + e.getMessage());
        }
    }
}
